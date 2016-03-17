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
class View_Groups extends View_Itemlist{
    //put your code here
    public $title = "Группы";
    
    
#######################################################
function content(){  
#################################################### ?>
<div class="group_list_template list">
    <div class="commoninfo">Total: <span class="count"></span> &nbsp; </div>
    <table>
        <thead>
            <tr>
                <th class="checkbox"><input type="checkbox"></th>
                <th class="name">Название</th>
                <th class="department">Отделение</th>
                <th class="faculty">Факультет</th>
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
                <td class="name"><%- name %> </td>
                <td class="department"><%= department == null ? "-no-specified-" : department.name %></td>
                <td class="faculty"><%= department == null || department.faculty == null ? "-no-specified-" : department.faculty.name %></td>
                <td class="actions">
                    <a href="#remove" title="remove">[-]</a>
                    <a href="#edit" title="edit">[*]</a>
                </td>
</script>

</div>


<script type="text/template" class="group_form_template">
   <div class="">
        <form>
            <div class="message">
                
            </div>
        <table class="editform">
            <tbody>
                <tr class="name"><td class="f_name">Название:</td><td class="f_val"><input class="model" name="name" value="<%- name %>"/></td></tr>
                <tr class="group"><td class="f_name">Отделение:</td><td class="f_val"><select class="model" name="department"><option value="0">--no-specified--</option></select></td></tr>
            </tbody>    
        </table>
             <div class="subjects">
                 <table>
                <?php 
                foreach ( is_array($this->subjects) ? $this->subjects : array() as $k=>$v){
                    //var_dump($v->getLecturers());
                    echo "
                        <tr class='sb_".$v->getIdSubject()."'>
                        <td><input class='model subject' type='checkbox' value='".$v->getIdSubject()."' name='group_has_subjects[$k][id_subject]' /></td>
                        <td>".$v->getName()."</td>
                        <td><select class='model type' name='group_has_subjects[$k][type]'><option value='0'>--no-specified--</option><option value='exam'>экзамен</option><option value='credit'>зачет</option><option value='both'>экзамен+зачет</option></select></td>
                        <td><select class='model lecturer' name='group_has_subjects[$k][id_lecturer]'>".$this->getLecturerOptions($v->getLecturers())."</select></td>
                        </tr>
                        ";    
                }
                ?>
                 </table>     
            </div>
            <div style="clear:both"></div>    
<?php $this->edit_form_bottom(); ?>         
    </form> 
</div>
</script>


<script type="text/javascript">
    $(function(){
    
        bbinit("groups");
        
    });
</script>

<?php ##################################################
}
########################################################    


    function getLecturerOptions($lecturers){
        $r="<option value='0'>--no-specified--</option>\r\n";
        
        foreach($lecturers ? $lecturers : array() as $k=>$v){
            
            $r.= "\r\n<option value='".$v->getIdLecturer()."'>".$v->getName()."</option>";
        }
        return $r;
    }


}

?>
