<?php
namespace Bitrix\ImOpenLines\Log;

class Library
{
	//Error codes
	const EVENTS_ERROR_NOT_ACTUAL_EVENT_ERROR_CODE = 1;
	const EVENTS_ERROR_EMPTY_LINE_ID_ERROR_CODE = 2;

	//Event codes
	const EVENT_SESSION_START = 'SESSION_START';
	const EVENT_SESSION_LOAD = 'SESSION_LOAD';
	const EVENT_SESSION_PAUSE = 'SESSION_PAUSE';
	const EVENT_SESSION_SPAM = 'SESSION_SPAM';
	const EVENT_SESSION_CLOSE = 'SESSION_CLOSE';
	const EVENT_SESSION_QUEUE_NEXT = 'SESSION_QUEUE_NEST';
	const EVENT_SESSION_DISMISSED_OPERATOR_FINISH = 'SESSION_DISMISSED_OPERATOR_FINISH';
	const EVENT_SESSION_VOTE_USER = 'SESSION_VOTE_USER';
	const EVENT_SESSION_VOTE_HEAD = 'SESSION_VOTE_HEAD';
}