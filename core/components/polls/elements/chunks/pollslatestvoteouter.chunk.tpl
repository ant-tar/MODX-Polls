<h2>[[+question]]</h2>
<p>[[+category_name:ne=``:then=`[[%polls.category? &name=`[[+category_name]]`]], `]][[%polls.totalvotes? &num=`[[+totalVotes]]`]]</p>

<form action="[[~[[*id]]]]" method="post">

<p>[[+answers]]</p>

<p><input type="submit" name="pollVote" value="[[%polls.vote]]" /></p>

</form>

[[+results_url:ne=``:then=`<p><a href="[[+results_url]]">[[%polls.showresults]]</a></p>`]]