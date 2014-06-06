/**
 * 
 */
var scroller  = null;
var scrollbar = null;
window.onload = function () {
  scroller  = new jsScroller(document.getElementById("Scroller-1"), 400, 200);
  scrollbar = new jsScrollbar (document.getElementById("Scrollbar-Container"), scroller, false);
}

function fetch_object(idname)
{
 var my_obj = document.getElementById(idname);
 return my_obj;
}
function toggle_nav(obj)
{
 for (i = 1; i<= 9; i++ )
 {
  var sub_nav = fetch_object("zzjs_nav" + i);
  var sub_nav_index = fetch_object("zzjs_nav0");
  sub_nav_index.style.display = "none";
  if (obj == i)
  {
   sub_nav.style.display = "block";
  }
  else
  {
   sub_nav.style.display = "none";
  }
 }
}