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
class View_Students extends View_Itemlist{
    //put your code here
    public $title = "Студенты";
    
    
#######################################################
function content(){  
#################################################### ?>
<div class="student_list_template list">
    <div class="commoninfo">Total: <span class="count"></span> &nbsp; </div>
    <table>
        <thead>
            <tr>
                <th class="checkbox"><input type="checkbox"></th>
                <th class="name">Имя</th>
                <th class="group">Группа</th>
                <th class="date">Дата</th>
                <th class="department">Отделение</th>
                <th class="passport">Данные паспорта</th>
                <th class="actions">
                    <a href="#create" title="Create new">[+]</a>
                    <a href="#removeselected" title="Remove selected">[-]</a>
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
                <td class="name"><%- name %></td>
                <td class="group"><%= group == null ? "-no-specified-" : group.name %></td>
                <td class="date"><%- rec_date %></td>
                <td class="department"><%= group == null || group.department == null ? "-no-specified-" : group.department.name %></td>
                <td class="passport"><%= passport == '' ? "-no-specified-" : passport %>&nbsp; </td>
                <td class="actions">
                    <a href="#remove" title="remove">[-]</a>
                    <a href="#edit" title="edit">[*]</a>
                </td>
</script>

</div>


<script type="text/template" class="student_form_template">
   <div class="">
        <form>
            <div class="message">
                
            </div>
        <table class="editform">
            <tbody>
                <tr class="name"><td class="f_name">Имя:</td><td class="f_val"><input class="model" name="name" value="<%- name %>"/></td></tr>
                <tr class="group"><td class="f_name">Группа:</td><td class="f_val"><select class="model" name="group"><option value="1">--no-specified--</option></select></td></tr>
                <tr class="date"><td class="f_name">Дата зачисления:</td><td class="f_val"><input class="model" name="rec_date" value="<%- rec_date %>"/></td></tr>
                <tr class="order_no"><td class="f_name">№ Приказа:</td><td class="f_val"><input class="model" name="order_no" value="<%- order_no %>"/></td></tr>
                <tr class="passport"><td class="f_name">Данные паспорта:</td><td class="f_val"><textarea class="model" name="passport"><%- passport %></textarea></td></tr>
            </tbody>    
        </table>
            <div class="subjects">
                <table>
               
                </table>    
            </div>
            
            <div style="clear:both"></div>  
<?php $this->edit_form_bottom(); ?>        
    </form> 
</div>
</script>

<script type="text/template" class="dept_template">
         
                        <td><%- subject.name %> <input class="model group_has_subject" value="<%- id_group_has_subject %>" type="hidden"> </td>
                        <td>Зачет</td>
                        <td><input class="model value credit" <%= type=='credit' || type=='both' ? '' : 'disabled="disabled"' %> type="text" value="" name="value_credit"> </td>
                        <td>Экзамен</td>
                        <td><input class="model value exam"  <%= type=='exam' || type=='both' ? '' : 'disabled="disabled"' %> type="text" value="" name="value_exam"> </td>
                        
</script>    


<script type="text/javascript">
    $(function(){
    
        bbinit("students");
        
    });
</script>

<?php ##################################################
}
########################################################    

    
}

?>
