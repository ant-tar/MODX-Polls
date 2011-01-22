--------------------
Polls
--------------------
Version: 1.1-rc2
Since: December 21th, 2010
Author: Bert Oost <bertoost85@gmail.com>

A simple Poll solution for MODx Revolution. Create questions 
and answers for it and add them into poll-categories.

The first release is very basic for what a poll can be but 
feel free to suggest ideas/improvements/bugs on the github.

Please see the GIT project: https://github.com/bertoost/MODx-Polls

And the official docs at http://rtfm.modx.com/display/ADDON/Polls


EXAMPLE USAGE
--------------------

You can create categories to link your polls too. This feature is 
for sites wich have multiple polls needed on different pages. For 
a simple usage, it's not necessary.

On the page you want to view the poll, just paste the snippet call 
in your template or resource content, like this:

[[!PollsLatest]]

TEMPLATES:

   tplVote - The main form template for the latest poll view
   tplVoteAnswer - The form template for the answers inside the main view
   tplResult - The main result template for the latest poll view
   tplResultAnswer - The result template for the answers inside the outer view

SELECTION:

   category - (Opt) will select the latest poll from the given category (id), could be multiple devided by a comma
   sortby - (Opt) to influence the normal order, order could be any field in list, defaults to id
   sortdir - (Opt) to influence the normal order direction, defaults to DESC
   [Note] No params; will select the latest poll from any category
          sortby and sortdir are normally not need to set

LINKING:

   resultResource - (Opt) when set to a resource id, this resource will be used to show the poll results
   resultLinkVar - (Opt) when using resultResource, this is the paramatername the snippet is looking for


[[!PollsResult]]

TEMPLATES:

   tpl - The main result template for the poll view
   tplAnswer - The result template for the answers inside the outer view

LINKING:

   resultLinkVar - (Opt) when using resultResource, this is the paramatername the snippet is looking for