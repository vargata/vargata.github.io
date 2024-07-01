<script src="submitscript.js"></script>
<script src="countchar.js"></script><pre>

<?php 
include 'db.php';

$dbase = new db();
$dbase->connect_db();
$subjects = $dbase->get_Subjects();
$dbase->close_db();
?>
<label class="formhead">Please leave a message</label>


<form method="POST">
<input type="text" id="fname" name="fname" placeholder="First name" required maxlength="20"/>
<input type="text" id="sname" name="sname" placeholder="Last name" required maxlength="50"/>
<input type="text" id="email" name="email" placeholder="EMail" required maxlength="100"/>
<input type="text" id="phone" name="phone" placeholder="Phone" required maxlength="11"/>
<?php
echo '<select id="subject" name="subject" onchange="this.className=this.options[this.selectedIndex].className" class="grayOption" required>'.PHP_EOL;
echo '<option value="" selected disabled class="grayOption">Select subject</option>'.PHP_EOL;
foreach($subjects as $key => $value) echo '<option value="'.$key.'" class="blackOption">'.$value.'</option>'.PHP_EOL;
echo '</select>'.PHP_EOL;
?>
<textarea id="msg" name="msg" placeholder="Enter your meassage..." required maxlength="500"></textarea>
<div class="submitdiv"><label id="charcount" class="charcount">0/500</label><input type="submit" class="submit" value="Send"/></div>
</form>
</pre>