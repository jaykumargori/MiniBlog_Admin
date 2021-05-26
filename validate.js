function required()
{
    var empt=document.forms["login"]["username"].value;
    var pass=document.forms["login"]["password"].value;

    if (empt && pass =="")
    {
        alert("Please a value");
        return false;

    }
    else
    {
        return true;

    }
}