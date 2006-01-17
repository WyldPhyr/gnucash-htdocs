<?php

include("include/header.inc");

include("include/table_top.inc");
print "Search results for $words";
include("include/table_middle.inc");

$HTSEARCH_PROG = "./htdig.sh";
# $swords = $words;
$swords = EscapeShellCmd(UrlEncode($words));
# $swords = UrlEncode(EscapeShellCmd($words));
# $config = "htdig";
# $format = "htdig";
$matchesperpage = 10;
# $sort = "time";

if(!$page)
{
#   $query = "config=$config&format=$format&words=$swords&restrict=$restrict&matchesperpage=$matchesperpage&sort=$sort&exclude=$exclude";
    $query = "words=$swords&restrict=$restrict&matchesperpage=$matchesperpage&sort=$sort&exclude=$exclude";
#    $query = "words=$swords&matchesperpage=$matchesperpage";
    $page = 1; 
}
else
#    $query = "config=$config&format=$format&words=$swords&restrict=$restrict&matchesperpage=$matchesperpage&page=$page&sort=$sort&exclude=$exclude";
    $query = "words=$swords&restrict=$restrict&matchesperpage=$matchesperpage&page=$page&sort=$sort&exclude=$exclude";
#    $query = "words=$swords&matchesperpage=$matchesperpage&page=$page";

/**** FUNCTIONS ****/

# function page_list($page, $matches)
# {
#    global $matchesperpage, $restrict, $words;
# 
#    $TotalPages = (int)($matches / $matchesperpage);
# 
#    if($matches % $matchesperpage) $TotalPages++;
# 
#    print "<center>\n";
# 
#    if($page > 1)
#    {
#        print "<a href=\"/search.php3?restrict=".urlencode($restrict)."&words=".urlencode($words)."";
#        print "&page=".($page-1)."\">"; 
#        print "<img src=\"/images/prev-yes.jpg\" border=\"0\"></a>\n";
#    }
#    else
#        print "<img src=\"/images/prev-no.jpg\" border=\"0\">";
#     
#    if($page < $TotalPages)
#    {
#        print "<a href=\"/search.php3?restrict=".urlencode($restrict)."&words=".urlencode($words)."";
#        print "&page=".($page+1)."\">";
#        print "<img src=\"/images/next-yes.jpg\" border=\"0\"></a>\n";
#    }
#    else
#        print "<img src=\"/images/next-no.jpg\" border=\"0\">";
#    
#    print "</center>\n";
# }

$command="$HTSEARCH_PROG \"$query\"";
exec($command,$result);

$rc = count($result);

# if ($rc<3):
#     echo "There was an error executing this query.  Please try later.\n";
# elseif ($result[2]=="NOMATCH"):
#     echo "There were no matches for <B>$words</B> found on the website.<P>&nbsp;";
#     echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n";
# elseif ($result[2]=="SYNTAXERROR"):
#     echo "There is a syntax error in your search for <B>$words</B>:<BR>";
#     echo "<PRE>" . $result[3] . "</PRE>\n";
# else:
#     $matches = $result[2];
#     $firstdisplayed = $result[3];
#     $lastdisplayed = $result[4];
#     $words = $result[5];
#     $pagelist = $result[6];
# 
#     echo "<center><h3>Search for <B>'$words'</B> returned <B>$matches</B> match";
#     echo ($matches==1) ? "" : "es";
#     echo "</h3></center>";
# 
#     //page_list($page, $matches);
# 
#     $i=7;
# 
#     print "<br><br>";

    $i=1;
 
    while($i<$rc) 
    {
        echo $result[$i] . "\n";
        $i = $i + 1;
    }
    
#this is broken
#     while($i<$rc) 
#     {
# 
#         # grab the match information
# 
#         $title = $result[$i];
#         $url = $result[$i+1];
#         $percent = $result[$i+2];
#         $excerpt = $result[$i+3];
# 
#         # output the match information
#         # append session id if necessary!
# 
# echo "<hr>Duude<hr>\n";
# echo $title . $url . $percent . $excerpt . "\n";
# #        echo "<font size=-1><A HREF=\"$url\">$title</A>\n";
# #        echo "<font size=-2><b>(" . $percent . "% match)</b></font><BR>\n";
# #        echo "<blockquote>" . $excerpt . "</blockquote><BR>\n";
# 
#         # move to the next match
# 
#         $i = $i + 4;
#     }
# endif;

# page_list($page, $matches);

include("include/table_bottom.inc");

include("include/footer.inc");

?>