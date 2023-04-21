<?php 
function setBalance($amount,$process,$accountNo)
{
	$con = new mysqli('localhost','root','','mybank');
	$array = $con->query("select * from userAccounts where accountNo='$accountNo'");
	$row = $array->fetch_assoc();
	if ($process == 'credit') 
	{
		$balance = $row['balance'] + $amount;
		return $con->query("update userAccounts set balance = '$balance' where accountNo = '$accountNo'");
	}else
	{
		$balance = $row['balance'] - $amount;
		return $con->query("update userAccounts set balance = '$balance' where accountNo = '$accountNo'");
	}
}
function setOtherBalance($amount,$process,$accountNo)
{
	$con = new mysqli('localhost','root','','mybank');
	$array = $con->query("select * from otheraccounts where accountNo='$accountNo'");
	$row = $array->fetch_assoc();
	if ($process == 'credit') 
	{
		$balance = $row['balance'] + $amount;
		return $con->query("update otheraccounts set balance = '$balance' where accountNo = '$accountNo'");
	}else
	{
		$balance = $row['balance'] - $amount;
		return $con->query("update otheraccounts set balance = '$balance' where accountNo = '$accountNo'");
	}
}
function makeTransaction($action,$amount,$other)
{
	$con = new mysqli('localhost','root','','mybank');
	if ($action == 'transfer')
	{
		return $con->query("insert into transaction (action,debit,other,userId) values ('transfer','$amount','$other','$_SESSION[userId]')");
	}
	if ($action == 'Cashout')
	{
		return $con->query("insert into transaction (action,debit,other,userId) values ('Cashout','$amount','$other','$_SESSION[userId]')");
		
	}
	if ($action == 'Cashin')
	{
		return $con->query("insert into transaction (action,credit,other,userId) values ('Cashin','$amount','$other','$_SESSION[userId]')");
		
	}
}
function makeTransactionAgent($action,$amount,$other,$userId)
{
	$con = new mysqli('localhost','root','','mybank');
	if ($action == 'transfer')
	{
		return $con->query("insert into transaction (action,debit,other,userId) values ('transfer','$amount','$other','$userId')");
	}
	if ($action == 'Cashout')
	{
		return $con->query("insert into transaction (action,debit,other,userId) values ('Cashout','$amount','$other','$userId')");
		
	}
	if ($action == 'Cashin')
	{
		return $con->query("insert into transaction (action,credit,other,userId) values ('Cashin','$amount','$other','$userId')");
		
	}
}
 ?>