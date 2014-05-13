<p>
Dear, <?php print $common_name; ?>
</p>
<p>
A fax has been received on <?php print $fax_date; ?>. 
</p>

<p>
Received at   : <?php print $fax_did; ?><br />
Received from : <?php print $caller_id . " " . (isset($caller_text)?" ($caller_text)":""); ?><br />
Total pages   : <?php print $fax_pages; ?><br /> 
Date / Time   : <?php print $fax_date; ?> 
</p>


<p>
-------------------------<br />
The <?php print $company_name; ?> Team<br />
</p>
