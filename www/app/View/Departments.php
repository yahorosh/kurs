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
class View_Departments extends View_Itemlist{
    //put your code here
    public $title = "Группы";
    
    
#######################################################
function content(){  
#################################################### ?>
<div class="department_list_template list">
    <div class="commoninfo">Total: <span class="count"></span> &nbsp; </div>
    <table>
        <thead>
            <tr>
                <th class="checkbox"><input type="checkbox"></th>
                <th class="name">Название</th>
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
                <td class="faculty"><%= faculty == null ? "-no-specified-" : faculty.name %></td>
                <td class="actions">
                    <a href="#remove" title="remove">[-]</a>
                    <a href="#edit" title="edit">[*]</a>
                </td>
</script>

</div>


<script type="text/template" class="department_form_template">
   <div class="">
        <form>
            <div class="message">
                
            </div>
        <table class="editform">
            <tbody>
                <tr class="name"><td class="f_name">Название:</td><td class="f_val"><input class="model" name="name" value="<%- name %>"/></td></tr>
                <tr class="group"><td class="f_name">Факультет:</td><td class="f_val"><select class="model" name="faculty"><option value="0">--no-specified--</option></select></td></tr>
            </tbody>    
        </table>
<?php $this->edit_form_bottom(); ?>          
    </form> 
</div>
</script>


<script type="text/javascript">
    $(function(){
    
        bbinit("departments");
        
    });
</script>

<?php ##################################################
}
########################################################    

    
}

?>
