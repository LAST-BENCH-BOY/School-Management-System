<body class="hold-transition skin-blue sidebar-mini" >
<div class="wrapper">
  <header class="main-header" >
    <!-- Logo -->
    <a href="" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><strong>GS</strong></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><strong>GOVT. SCHOOL</strong></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
		<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
       		<span class="sr-only">Toggle navigation</span>
       	</a>
		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
            
              <!-- Notifications: style can be found in dropdown.less -->
              <!-- <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i> -->
<?php
include_once('../controller/config.php');
$my_type=$_SESSION["type"];

if($my_type == 'Teacher'){
	
	$sql1="SELECT COUNT(id) FROM main_notifications WHERE _isread='0'";
	$result1=mysqli_query($conn,$sql1);
	$row1=mysqli_fetch_assoc($result1);
	$notfi_count=$row1['COUNT(id)'];
	
?>
                  <!-- <span class="label label-warning"><?php echo $notfi_count; ?></span> -->
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have <?php echo $notfi_count; ?> notifications</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
<?php
include_once('../controller/config.php');

$sql="SELECT * FROM main_notifications ORDER BY id DESC";
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_assoc($result)){
	$_status=$row['_status'];
	$notification_id=$row['notification_id'];
	
	if($_status=="Events"){
		$sql1="SELECT * FROM events WHERE id='$notification_id'";
		$result1=mysqli_query($conn,$sql1);
		$row1=mysqli_fetch_assoc($result1);
		$title1=$row1['title'];
		
		
		echo '<li>
              	<a href="#" onClick="showNotifyEvent('.$notification_id.')">
                    <i class="fa fa-users text-aqua"></i> You have new event - '.$title1.'
                </a>
              </li>
                      
              ';
		
	}
	
	
}

?>
					</ul>
                  </li>
                  <li class="footer"><a href="#" onClick="viewAllNotifi()">View all</a></li>
                </ul>
              </li>
<?php }  ?>           
           
<script>
var count = 0;

function viewAllNotifi(){
	
	var xhttp = new XMLHttpRequest();//MSK-00149-Start Ajax  
  		xhttp.onreadystatechange = function() {
    		if (this.readyState == 4 && this.status == 200) {
				
				document.getElementById('viewAllNotification').innerHTML = this.responseText;
				$('#modalviewAllNotifications').modal('show');
				count++;
				
    		}
			
  		};	
		
    	xhttp.open("GET", "all_notifications.php", true);												
  		xhttp.send();
}

function viewNotifications(std_index,due_month,due_year,notifications_id){
	
	$("#modalviewAllNotifications").modal('hide');
	
	var xhttp = new XMLHttpRequest();//MSK-00149-Start Ajax  
  		xhttp.onreadystatechange = function() {
    		if (this.readyState == 4 && this.status == 200) {
				
				document.getElementById('viewDuePayment').innerHTML = this.responseText;
				$('#modalviewDuePayment').modal('show');
				
				notifiRead(notifications_id);
    		}
			
  		};	
		
    	xhttp.open("GET", "student_due_payment.php?std_index=" + std_index +"&due_month="+due_month +"&due_year="+due_year, true);												
  		xhttp.send();
	
}

function showNotifyEvent(event_id){
	
	$("#modalviewAllNotifications").modal('hide');
	var xhttp = new XMLHttpRequest();//MSK-00105-Ajax Start  
		xhttp.onreadystatechange = function() {
				
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById('showEvent2').innerHTML = this.responseText;//MSK-000132
				$('#modalviewEvent5').modal('show');
				notifiRead(event_id);
			}
				
		};	
		
		xhttp.open("GET", "show_events2.php?event_id="+event_id , true);												
		xhttp.send();//MSK-00105-Ajax End
};

function showAllNotfi1(){
	
	if(count > 0){
		viewAllNotifi();
	}
	
}

function countEquel0(){
	
	count = count-count;
	
}
 
</script>           
                   

              <!-- Messages: style can be found in dropdown.less-->
                <ul class="dropdown-menu">
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
<?php

include_once('../controller/config.php');

$index=$_SESSION["index_number"];
$type=$_SESSION["type"];

		
?>                          
 
                    </ul>
                  </li>
                  <li class="footer"><a href="#">See All Messages</a></li>
                </ul>
              </li> 


<?php 

?>

<?php
include_once('../controller/config.php');

if($type=="Student"){
	$sql="SELECT * FROM student where index_number='$index'";
	$result=mysqli_query($conn,$sql);
	$row=mysqli_fetch_assoc($result);
}

if($type=="Teacher"){
	$sql="SELECT * FROM teacher where index_number='$index'";
	$result=mysqli_query($conn,$sql);
	$row=mysqli_fetch_assoc($result);	
}

if($type=="Admin"){
	$sql="SELECT * FROM admin where index_number='$index'";
	$result=mysqli_query($conn,$sql);
	$row=mysqli_fetch_assoc($result);	
}

?> 

                <!-- User Account: style can be found in dropdown.less -->
            	<li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <img src="../<?php echo $row['image_name']; ?>" class="user-image" alt="User Image">
                      <span class="hidden-xs"><?php echo $row['i_name']; ?></span>
                    </a>
                    <ul class="dropdown-menu">
                      <!-- User image -->
                      <li class="user-header">
                        <img src="../<?php echo $row['image_name']; ?>" class="img-circle" alt="User Image">
        
                        <p>
                          <?php echo $row['i_name']; ?> - <?php echo $type; ?>
                          <?php
                          		$date = strtotime($row['reg_date']);
                                echo '<small>'."Member since ".date('M'.'.'.' Y', $date).'</small>';
                           ?>
                        </p>
                      </li>
                      <!-- Menu Body -->
                      
                      <!-- Menu Footer-->
                      <li class="user-footer">
                        <div class="pull-left">
                          <a href="teacher_profile2.php" class="btn btn-default btn-flat">Profile</a>
                        </div>
                        <div class="pull-right">
                          <a href="login.php" class="btn btn-default btn-flat">Sign out</a>
                        </div>
                      </li>
                    </ul>
              </li>
            </ul> 
        </div>
	</nav>
  </header>
  <div class="row" id="fProfile">
        
  <!-- </div>
  <div id="viewDuePayment">
     -->
  </div>
  <div id="viewAllNotification">
    
  </div>
  <div id="stdProfile">
    
  </div>
  <div id="showEvent2">
  
  </div>
  
   <!-- //MSK-000124 Modal-Delete Confirm Popup -->
	<div class="modal msk-fade" id="deleteConfirmReq" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  		<div class="modal-dialog">
    		<div class="modal-content">
				<div class="modal-header bg-primary">
        			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        			<h4 class="modal-title" id="frm_title">Delete</h4>
      			</div>

				<div class="modal-body bgColorWhite">
        			<strong style="color:red;">Are you sure?</strong>  Do you want to Delete this Friend Request.
        		</div>
      			<div class="modal-footer">
					<a href="#" style='margin-left:10px;' id="btnYesReq" class="deletebtn btn btn-danger col-sm-2 pull-right">Yes</a><!-- MSK-000125 -->
        			<button type="button" class="btn btn-primary col-sm-2 pull-right" data-dismiss="modal" id="frm_cancel">No</button>
      			</div>
    		</div>
  		</div>
	</div>
    
    <script>

$('body').on('click', '.confirm-delete-friend-req', function (e){
//MSK-000122		
    e.preventDefault();
    var id = $(this).data('id');
	$('#deleteConfirmReq').data('id1', id).modal('show');//MSK-000123
	

});

$('#btnYesReq').click(function() {
//MSK-000126
    var myArray = $('#deleteConfirmReq').data('id1').split(',');	
	var my_index = myArray[0];
	var friend_index = myArray[1];

	var do1 = "delete_friend_request";	
		
	var xhttp = new XMLHttpRequest();//MSK-000127-Ajax Start  
  		xhttp.onreadystatechange = function() {
			
    		if (this.readyState == 4 && this.status == 200) {
				//MSK-000129
				var myArray = eval( xhttp.responseText );
			
				if(myArray[0]==1){//MSK-000130
				
					$("#deleteConfirmReq").modal('hide');	
					 Delete_alert(myArray[0])
				
				 }
		
				 if(myArray[0]==2){//MSK-000137
			
					$("#deleteConfirmReq").modal('hide');
					 Delete_alert(myArray[0])
					
				 }

    		}
			
  		};	
    	
		xhttp.open("GET", "../model/delete_friend_request.php?my_index=" + my_index + "&friend_index="+friend_index + "&do="+do1  , true);												
  		xhttp.send();//MSK-000127-Ajax End
	 			   		
});

function Delete_alert(msg){
//MSK-000136	
	if(msg==1){
		
    	var myModal = $('#delete_Success');
		myModal.modal('show');
		
		clearTimeout(myModal.data('hideInterval'));
    	myModal.data('hideInterval', setTimeout(function(){
    		myModal.modal('hide');
			
    	}, 3000));
			
	}
	
	if(msg==2){
		
    	var myModal = $('#connection_Problem');
		myModal.modal('show');
		
    	clearTimeout(myModal.data('hideInterval'));
    	myModal.data('hideInterval', setTimeout(function(){
    		myModal.modal('hide');
    	}, 3000));
				
	}

};	

</script>
    
<style>
.msk-fade {  
      
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s

}  
  /* Add Animation */
@-webkit-keyframes animatetop {
    from {top:-300px; opacity:0} 
    to {top:0; opacity:1}
}

@keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
}

.modal-content1 {
   position: absolute;
   left: 25%; 
}

</style>