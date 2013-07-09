<?php
require ("../functions.php");
require("../auth_head.php");
html_header("计科一班--个人中心");
?>
<div style="padding: 0px 0px 50px; margin: 0px; border-width: 0px; height: 0px; display: block;" id="yass_top_edge_padding"></div>
  <div class="navbar  navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="brand" href="../">SYSUCS.ORG</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="#">个人中心</a></li>
              <li><a href="message.php">消息</a></li>
              <li><a href="rank.php">排行榜</a></li>
              <li><a href="../mission.php">签到</a></li>
              <li><a href="dandan.php">辉宇蛋蛋店</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

<div class="container" >

<?php
$dbc = newDbc();
$user = $_SESSION['user'];
$nowip =get_user_ip();

$query ="select * from user where name='".$user."'";
$result=mysqli_query($dbc,$query);
$row=mysqli_fetch_array($result);

echo "<div class='alert alert-info'>".$user." 您好！,当前ip为<code>".$nowip."</code>";
if(isset($_SESSION['auto']) && $_SESSION['auto'] ==1)
{
    echo"您正在使用ip自动认证</div>";
}
else
{
    $query ="select * from user where name = '".$user."'";
    $result = mysqli_query($dbc,$query);
    $row = mysqli_fetch_array($result);
//    echo "您已经绑定ip <code>".$row['ip']."</code> 使用该ip访问本网站将无需登陆。";
    echo "</div>";
}

?>
<div class="row">
  <div class="span6">
    <h4><?php echo $user ?>资料更改</h4> 
    <form action="change.php" method="post" class="form-horizontal">

  <div class="control-group">
        <label class="control-label" >登录名</label>
        <div class="controls">
            <input name="name" type="text" disabled value="<?php echo $user ?>" />
             <!-- 改这里的disabled是没有用的== --!>
        </div>
  </div>

<div class="control-group">
        <label class="control-label" >昵称</label>
        <div class="controls">
            <input name="nickname" type="text"  value="<?php echo $row['nickname']?>" />
        </div>
      </div>


<div class="control-group">
        <label class="control-label" >签名档</label>
        <div class="controls">
<textarea id="signature" name="signature" rows="2" cols="30"><?php echo $row['signature'];?></textarea>
        </div>
      </div>

      <div class="control-group">
        <label class="control-label" >绑定ip </label>
        <div class="controls">
            <input id="ip" name="ip" type="text" value="<?php echo $row['ip']; ?>" />
        </div>
      </div>



<div class="control-group">
        <label class="control-label" >当前密码</label>
        <div class="controls">
      <input  name="old" type="password" />
        </div>
      </div>
<div class="control-group">
        <label class="control-label" >新密码</label>
        <div class="controls">
      <input  name="new1" type="password" />
        </div>
      </div>
<div class="control-group">
        <label class="control-label" >再次输入</label>
        <div class="controls">
      <input  name="new2" type="password" />
        </div>
      </div>
    <div class="control-group">
        <div class="controls">
      <input class ="btn btn-primary" type="submit" value="submit" />
      <p class="help-block">如果不需要更改密码，则新密码留空即可</p>
      <p class="help-block">如果ip也不需要更改，则当前密码也可以留空</p>
        </div>
      </div>







    </form>
  </div>
  <div class="span5">
    <h4>计科币转让</h4>
    <form action="trans.php" method="post" class="form-horizontal">

        <div class="control-group">
          <label class="control-label" >转出数量</label>
          <div class="controls">
            <input id="" name="num" type="number" value="9"/>
      <p class="help-block">转让扣取<code>20%</code>作为手续费！即转100，对方收到80，扣取20</p>
          </div>
        </div>
 <div class="control-group">
          <label class="control-label" >转入账户</label>
          <div class="controls">
      <input id="" name="to" type="text" />
          </div>
        </div>
<div class="control-group">
        <label class="control-label" >转账缘由</label>
        <div class="controls">
<textarea id="reason" name="reason" rows="1" cols="30"></textarea>
        </div>
      </div>


 <div class="control-group">
          <label class="control-label" >你的密码</label>
          <div class="controls">
      <input id="" name="password" type="password" />
          </div>
        </div>


 <div class="control-group">
          <label class="control-label" ></label>
          <div class="controls">
      <input class="btn btn-primary" type="submit" value="submit" />
      <p class="help-block">金钱交易有风险，请注意识别!</p>
          </div>
        </div>

    </form>

  </div>
</div>

<hr />
<h4>计科币
<?php
echo "当前剩余 <code><big>".$row['coin']."</big></code>,<small><a href='rank.php'>查看排行榜</a></h4>";
$query ="select * from coin where user='".$user."' order by date desc";
$result = mysqli_query($dbc,$query);
$n =$result->num_rows;
$all =safeGet('all');
if($all!=true)
{
    if($n>25)
        $n =25;
}
echo "<a name='more'></a>";
for($i=0;$i<$n;$i++)
{
    $row= mysqli_fetch_array($result);
    echo "<p>".date("m/d H:i",$row['date']).",".$row['type']." <code>".$row['num']."</code></p>";
}
if($all!=true)
{
    echo " <a class='btn' href='?all=true#more'>查看全部</a> ";
}



?>
<br />




</div>


