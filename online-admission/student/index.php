<?php 
include "top.php";
include "header.php";
include "../../classes/admin_class.php";

$admin = new admin_class();

$rowObj = $admin->getCollegeDetails();
$application_fee = $admin->getConstant("APPLICATION_FEE");
$bank_name = $admin->getConstant("BANK_NAME");
$branch_accounts = $admin->getConstant("BRANCH_ACCOUNT");


?>
<p><strong>Welcome to <?php echo $rowObj->name ?> College Student Panel. Please click the menus on the left side to operate</strong></p>

<div align="justify" >
<h3>1. Form Fill-up</h3><hr />
<ul>
<li>Open online admission form by clicking the link in College Website website.</li>
</li>Fill up all the field and submit the form. </li>
<li>Applicant will receive a mail and SMS with submission of form.  They will get password to enter into the student panel. </li>
<li>Applicant pays the Application Fee directly to the bank. After depositing the application fee, student has to confirm the application.</li>
<li><b>For each application applicant has to pay <?php echo $application_fee; ?>. Without depositing the application fee, it will be considered as CANCELLED.</b></li>
<li>After depositing the Application Fee, Student has to logon to the student panel with user id ( mobile number) and the password (sent through SMS) and confirm Form Submission.</li>
</ul>
<p style="color:rgb(219, 14, 14);">NOTE: Application once submitted cannot be changed.  In case of any error, Student has to cancel the submitted form and submit a fresh form. Cancellation is possible in every stage of Admission.</p>
<h3>2. Rank Generation and Admission </h3><hr />
<ul>
<li>Once the rank is generated, all the eligible students will get a mail to take admission online from student login panel.</li>
<li>A student then logs into the panel and accept the admission by clicking the confirm button.</li>
<li>Student , then  deposit the admission fee to the bank.  Check different fee structure from student panel.</li>
<li>Students are directed to bring the following documents in original at the time of admission to the college on the date given in the notice board, after depositing the admission fee to the Bank. </li>
<br />
<ol type="i">
<li>Proof of Birth date ( 10th Admit Card / Certificate )</li>
<li>12th Mark Sheet</li>
<li>2 copies of Photo (Stamp Size)</li>
<li>Caste Certificate (if any)</li>
<li>2 nos. Bank Deposit Chalans (Form Fillup Fee and Admission Fee)</li>
<li>Print Out of the submitted form</li>
</ol>
</ul>
<br />
<b>DEPOSIT OF MONEY TO THE BANK - <?php echo $bank_name; ?></b><hr />
<p><b><?php echo $branch_accounts; ?></b>
<p>
Each Student can deposit the money either by cash to any branch of State bank of India or by Online Money Transfer. Students are requested to keep the deposit slip (in case of bank deposit by cash) or the printout of the transaction (in case of online transfer)
<br />
<p style="color:rgb(219, 14, 14);">NOTE: KEEP THE DEPOSITE SLIP FOR FUTURE REFERENCE. ALL THE DOCUMENTS ALONG WITH THE DEPOSITE SLIP IS REQUIRED IN ORDER TO GET THE ADMISSION. IF ANY CASE ANY DOCUMENT IS MISSED, THE ADMISSION WILL BE CANCELLED.</p>

</div>

<?php include "footer.php";?>