<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of View
 *
 * @author horoshev
 */
class View_Layout_Base extends FW\View_Html {
    //put your code here
      

function __construct() {
    $this->addStyle("/css/base.css");
    $this->addScript('/js/jquery.min.js');
    $this->addScript('/js/jquery.serialize-object.js');
    $this->addScript('/js/underscore.js');
    $this->addScript('/js/backbone.js');
    
    $this->addScript('/js/fancybox/lib/jquery.mousewheel-3.0.6.pack.js');
    $this->addStyle('/js/fancybox/source/jquery.fancybox.css?v=2.1.4');
    
    $this->addScript("/js/fancybox/source/jquery.fancybox.pack.js?v=2.1.4");
    
    
    $this->addScript('/js/bbinit.js');
    
    parent::__construct();
}

#######################################################
function html() {
#################################################### ?>
<html>
    <head>
       <?php echo $this->head(); ?>
    </head>
    <body>
       <?php echo $this->body(); ?>
    </body>
</html>
<?php #################################################
}
#######################################################


    
#######################################################
function head() {
#######################################################
    
        echo "<title>".$this->title."</title>";
        $this->scripts();
        $this->styles();
        
        echo "<script> var timeOffset = ".(strtotime(gmdate("Y-m-d H:i:s")) - strtotime(date("Y-m-d H:i:s")))."; </script>";
        
#######################################################
}
#######################################################
    
    
#######################################################
function body() {
#################################################### ?>
<div class="wrap">
    <div class="menu">
        <?php $this->menu(); ?>        
    </div>


    <div class="base_content">

        <?php $this->content(); ?>

    </div>
</div>        
    
<?php #################################################
}
#######################################################

     
     
     
    
#######################################################
function login_form() {
################################################### ?>
 
<?php if($this->logged) { ?>
<div>
    You logged as <?php echo $this->username; ?>
</div>
            <?php } else { ?>
<div>
    <form>
        
        <input type="hidden" name="controller" value="index"/>
        <input type="hidden" name="action" value="login"/>

        <input type="text" name="login"/>
        <input type="text" name="pass"/>
    </form>

</div>

<?php } ?>
      
<?php #################################################
}
#######################################################

    
    
#######################################################
function menu(){
#################################################### ?>
        
<div class="base_menu">
    <ul>
        <li class="<?php echo $this->action == 'deans' ? 'active' : '' ?>"><a href="/editor/deans">Деканаты</a></li>
        <li class="<?php echo $this->action == 'students' ? 'active' : '' ?>"><a href="/editor/students">Студенты</a></li>
        <li class="<?php echo $this->action == 'groups' ? 'active' : '' ?>"><a href="/editor/groups">Группы</a></li>
        <li class="<?php echo $this->action == 'departments' ? 'active' : '' ?>"><a href="/editor/departments">Отделения</a></li>
        <li class="<?php echo $this->action == 'faculties' ? 'active' : '' ?>"><a href="/editor/faculties">Факультеты</a></li>
        <li class="<?php echo $this->action == 'lecturers' ? 'active' : '' ?>"><a href="/editor/lecturers">Преподаватели</a></li>
        <li class="<?php echo $this->action == 'subjects' ? 'active' : '' ?>"><a href="/editor/subjects">Предметы</a></li>
        
    </ul>
</div>    
                        
<?php ##################################################
}
#######################################################    



#######################################################
function content(){  
#################################################### ?>

<div> Standart content!</div>

<?php ##################################################
}
########################################################    


}
