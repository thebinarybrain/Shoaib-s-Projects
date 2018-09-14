var x=1;
function f()
{
var img=["1.jpg","2.jpg","3.jpg","4.jpg","5.jpg","6.jpg","7.jpg","8.jpg","9.jpg","10.jpg","11.jpg","12.jpg"];
var c=document.getElementById("imain");
if(x>11)
x=0;
c.setAttribute("src",img[x]);
x++;
}
setInterval(f,3000);
function thumbnail()
{
	var t=document.getElementById("imain");
	var n=document.getElementById("carouselthumbnail");
	var e=t.getAttribute("src");
	if(e=="1.jpg")
		n.innerHTML="SMART REFRIGERATOR IT CAN BE YOURS ON A SINGLE CLICK";
	else if(e=="2.jpg")
		n.innerHTML="YOU ARE ON THE RIGHT PLATFORM FOR CRICKET KITS";
	else if(e=="3.jpg")
		n.innerHTML="GRAB THIS BASEBALL JACKET TO AMUSE MORE";
	else if(e=="4.jpg")
		n.innerHTML="CATCH THIS MOBILE-PHONE IT WILL HELP YOU OUT";
	else if(e=="5.jpg")
		n.innerHTML="HEALTH IS WEALTH HURRY UP, TO BE FIT";
	else if(e=="6.jpg")
		n.innerHTML="BEING A CHILDREN IS ALWAYS AMAZING JUST BUY THE GAME";
	else if(e=="7.jpg")
		n.innerHTML="MAKE YOUR KIDS SMART AND CREATIVE ENOUGH";
	else if(e=="8.jpg")
		n.innerHTML="READING IS A HEALTHY HABIT MAKE YOURS MORE HEALTHIER";
	else if(e=="9.jpg")
		n.innerHTML="LADIES FIRST SO JUST BE THE LIGHT OF SKY WITH THESE BAGS";
	else if(e=="10.jpg")
		n.innerHTML="BE WITH THE TECHNOLOGY LEAD THE WORLD";
	else if(e=="11.jpg")
		n.innerHTML="JUST COOL YOURSELF AND MAKE YOUR TUMMY ALSO";
	else if(e=="12.jpg")
		n.innerHTML="HAVE SMART FUN ON SMART TV LIVE THE MOMENTS";

}
setInterval(thumbnail,3000);
