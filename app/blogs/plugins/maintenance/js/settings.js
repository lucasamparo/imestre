
$(function(){$('.recall-for-all').attr('disabled','disabled');$('#settings_recall_all').change(function(){if($(this).attr('selected')!='selected'){$('.recall-per-task').attr('disabled','disabled');$('.recall-for-all').removeAttr('disabled');}});$('#settings_recall_separate').change(function(){if($(this).attr('selected')!='selected'){$('.recall-per-task').removeAttr('disabled');$('.recall-for-all').attr('disabled','disabled');}});});