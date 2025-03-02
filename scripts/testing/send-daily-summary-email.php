<?php

/*
 * FileSender www.filesender.org
 * 
 * Copyright (c) 2009-2012, AARNet, Belnet, HEAnet, SURFnet, UNINETT
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 * 
 * *	Redistributions of source code must retain the above copyright
 * 	notice, this list of conditions and the following disclaimer.
 * *	Redistributions in binary form must reproduce the above copyright
 * 	notice, this list of conditions and the following disclaimer in the
 * 	documentation and/or other materials provided with the distribution.
 * *	Neither the name of AARNet, Belnet, HEAnet, SURFnet and UNINETT nor the
 * 	names of its contributors may be used to endorse or promote products
 * 	derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE
 * FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
 * DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
 * SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY,
 * OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */


require_once(dirname(__FILE__).'/../../includes/init.php');

Logger::setProcess(ProcessTypes::CRON);
Logger::info('Cron started');

$tid = $argv[1];
echo "transfer id $tid \n";

$transfer = Transfer::fromId($tid);
    
$start_time = time() - 24 * 3600;
$events = array();
    
foreach($transfer->auditlogs as $log) {
    if($log->created < $start_time) continue;
    if($log->author_type != 'Recipient') continue;
    if(!in_array($log->event, array(LogEventTypes::DOWNLOAD_ENDED, LogEventTypes::ARCHIVE_DOWNLOAD_ENDED))) continue;
        
    $events[] = array(
        'who' => $log->author->email,
        'what' => ($log->event == LogEventTypes::ARCHIVE_DOWNLOAD_ENDED) ? 'archive' : 'file',
        'what_name' => ($log->event == LogEventTypes::ARCHIVE_DOWNLOAD_ENDED) ? '' : $log->target->name,
        'when' => $log->created
    );
}
    
ApplicationMail::quickSend('daily_summary', $transfer->owner, $transfer, array('events' => $events));

