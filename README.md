<h3>YII QUIZ</h3>
<p>The results of these tasks:</p>

<ol>
  <li>Make validation process for following form (based on yii framework):
    <p>a) Form has following fields:</p>
      <p>- name:textbox - if name length > 2 chars and there is at least 2 words</p>
      <p>- city:textbox - length should be > 2</p>
      <p>- zip:textbox - if country == usa than length of zip should be 5, otherwise length does not matter, create it as a new validator class</p>
      <p>- state: textbox - required only if country == usa, otherwise just ignored (processed by 'safe' rule)</p>
      <p>- country:dropdown - required, range of country from the given list</p><br>
  
  <p>b) Also, make a tabular input of emails related to form above with following fields:</p>
      <p>- email:textbox - should match email pattern</p>
  </li>
  
  <li>Configuration files organization (this is not Yii specific, but you can describe it based on yii framework).
    <p>there is dev (dev.projectname.com) and productioN (www.projectname.com) servers.</p>
    <p>there is 5 developers with own local servers. their names: 'zigmund', </p>
    <p>'teodor', </p>
    <p>'joker', </p>
    <p>'rodriges', </p>
    <p>'pumpam'.</p><br>
  
    <p>all configs exists at each servers. (so using svn:ignore or git:ignore not possible. )</p>
    <p>each of this servers should work automatically by using proper config file based on $_SERVER['SERVER_NAME']. (means we cant change anything on server, eg environment variables and etc, except of local server.) </p><br>
  
    <p>please describe your best way of config files organization which allows select proper configuration.</p>
  </li>
  
  <li>Make standalone yii widget (based on yii framework).
    <p>There is jquery plugin http://jquery.malsup.com/cycle/</p>
    <p>Need make yii widget based on it and display it at above form page. </p>
    <p>In result we should be able call it by following way:</p>
    <p> <?php $this->widget('jQueryCycle',array('images'=>array('path/to/image1.png','path/to/image2.png',....),'fx'=>'zoom','sync'=>false,'delay'=>-2000)); ?></p>
  </li>
</ol>
