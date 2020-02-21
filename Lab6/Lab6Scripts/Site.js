/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function ChangeSemester(){
    var frm = getElememtById("myForm");
    frm.submit();
    var link = "CourseSelection.php?selectedSemesterCode=" + $('#selectedSemester').val();
     window.location.replace(link);
} 
function confirmDelete(){
     if (!confirm("Selected registrations will be deleted!")) {
                    return false;
        }
}