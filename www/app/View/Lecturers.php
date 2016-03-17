<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Students
 *
 * @author horoshev
 */
class View_Lecturers extends View_Itemlist{
    //put your code here
    public $title = "Группы";
    
    
#######################################################
function content(){  
#################################################### ?>
<div class="lecturer_list_template list">
    <div class="commoninfo">Total: <span class="count"></span> &nbsp; </div>
    <table>
        <thead>
            <tr>
                <th class="checkbox"></th>
                <th class="name">Имя:</th>
                <th class="degree">Степень:</th>
                
                
                
                <th class="actions">
                    <a href="#create" title="Create new">[+]</a>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                
            </tr>
        </tbody>
    </table>

<script type="text/template" class="item_template">
                <td class="checkbox"><input type="checkbox" name="items[]" value="1"></td>
                <td class="name"><%- name %> &nbsp;</td>
                <td class="degree"><%- degree %> &nbsp;</td>
                
                <td class="actions">
                    <a href="#remove" title="remove">[-]</a>
                    <a href="#edit" title="edit">[*]</a>
                </td>
</script>

</div>


<script type="text/template" class="lecturer_form_template">
   <div class="">
        <form>
            <div class="message">
                
            </div>
        <table class="editform">
            <tbody>
                <tr class="name"><td class="f_name">Имя:</td><td class="f_val"><input class="model" name="name" value="<%- name %>"/></td></tr>
                <tr class="address"><td class="f_name">Адрес:</td><td class="f_val"><input class="model" name="address" value="<%- address %>"/></td></tr>
                <tr class="phone"><td class="f_name">Телефон:</td><td class="f_val"><input class="model" name="phone" value="<%- phone %>"/></td></tr>
                <tr class="passport"><td class="f_name">Паспорт:</td><td class="f_val"><input class="model" name="passport" value="<%- passport %>"/></td></tr>
                <tr class="chief"><td class="f_name">Начальник:</td><td class="f_val"><select class="model" name="id_chief"><option value="0">--no-specified--</option></select></td></tr>
                <tr class="degree"><td class="f_name">Степень:</td><td class="f_val"><input class="model" name="degree" value="<%- degree %>"/></td></tr>
                <tr class="salary"><td class="f_name">Зарплата:</td><td class="f_val"><input class="model" name="salary" value="<%- salary %>"/></td></tr>
            </tbody>    
        </table>
            <div class="subjects">
                <?php 
                foreach ( is_array($this->subjects) ? $this->subjects : array() as $k=>$v){
                 echo "<div class='subject-select'><input class='model' type='checkbox' value='".$v->getIdSubject()."' name='subjects[][id_subject]' />".$v->getName()."</div>";    
                }
                ?>
            </div>
            <div style="clear:both"></div>
            
<?php $this->edit_form_bottom(); ?>     
    </form> 
</div>
</script>


<script type="text/javascript">
    $(function(){
    
        bbinit("lecturers");
        
    });
</script>

<?php ##################################################
}
########################################################    

    
}

?>
