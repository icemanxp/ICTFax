Dear, 

A fax has been received on <?php print $fax_date; ?>. 


Received at   : <?php print $fax_did; ?> 
Received from : <?php print $caller_id . " " . (isset($caller_text)?" ($caller_text)":""); ?> 
Total pages   : <?php print $fax_pages; ?> 
Date / Time : <?php print $fax_date; ?> 

-------------------------
The <?php print $company_name; ?> Team
