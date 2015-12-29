<?php
header("Content-Type:text/html;charset=utf-8");
/**
 * 看看权限控制的一个bug
 * @author ibm
 */
class Test{
    private $money = 1000;
    public function getMoney($people){
        return $people->money;
    }

    public function setMoney($people){
        $people->money -= 500;
    }
}

$biyj = new Test();
$houzl = new Test();
//echo $houzl->money; //不可以

echo '<br />',$biyj->getMoney($houzl);
$biyj->setMoney($houzl);
echo '<br />',$biyj->getMoney($houzl),'<br />';
print_r($houzl);
/*
 * biyj读取和改变houzl的钱：
 * 1.如果从生活角度类看，是不合理的。钱私有，是指“每个对象的钱，针对每个对象私有”，
 *   即houzl的钱，由houzl-》showMoney才能引用；
 *   biyj不应该有权直接引用，或者说，biyj->getMoney,也只有权引用和改变biyj的钱。
 * 
 * 2.从上面的代码实践中，biyj却显然引用隔阂改变houzl的钱，这是因为：
 *   PHP在实现上，并不是以对象为单位来控制的权限；而是以类为单位来控制的权限。所以前一节，不断强调，类内、类外，而
 *   不是说对象内、对象外
 * 
 *   因为类声明依稀，而对象却可能非常多，以类为单位，简化了判断模型
 * 
 * 3.从代码构写的角度来看：
 *   zend引擎
 *   ce==EG(scope) 这一句判断的事调用者属性的类 与 执行上下文所属的类 是否相等
 *   在我们判断中，$lisi-->类-->Human类，而$lisi调用的setMoney也在Human类中，在同一个类内部，
 *   可以调用。这也说明了，确实是以类为单位，以类内类外为界限做的判断。
 * 
 *   case ZEND_ACC_PRIVATE:
 *      if ((ce==EG(scope) || property_info->ce==EG(scope) && EG(scope)){
 *          return 1;
 *      } else {
 *   }
 * 
 * 4.从其他语言中看
 *   java，C#也存在此问题
 * 
 * 5.从面相对象的角度来考虑：我们的写法，也有问题，就不应该把一个对象，直接传给一个方法来使用；而应该
 *   方法使用；而应该zhangsan borrow钱，应该对象houzl send钱
 *   即应该尽量的来调用对象的方法，而不应该直接把对象当成参数传过去
 */

?>