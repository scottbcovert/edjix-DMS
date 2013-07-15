<?php 
 //WARNING: The contents of this file are auto-generated


				$job_strings['aow']='processAOW_Workflow';

				function processAOW_Workflow() {
                    require_once('modules/AOW_WorkFlow/AOW_WorkFlow.php');
                    $workflow = new AOW_WorkFlow();
                    return $workflow->run_flows();
				}
?>