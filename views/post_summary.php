[[ $author = findUserById($post['user_id']); ]]
<div class="row mt-4">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        <a href="@@post/view/{{$post['id']}}@@"><span class="h4">{{$post['title']}}</span></a><span class="text-muted float-right"> Posted {{time2str($post['datestamp'])}} by <a href="@@user/view/{{$post['user_id']}}@@">{{$author['firstName']}} {{$author['lastName']}}</a></span>
      </div>
      <div class="card-body">
        {{{nl2br(htmlentities(substr($post['content'], 0, 500)))}}}
[[ if (strlen($post['content']) > 500): ]]
&nbsp;<a href="post/view/{{$post['id']}}">see more...</a>
[[ endif; ]]
      </div>
[[ if ($post['tags']): ]]
      <div class="card-footer">
        Filed under: {{$post['tags']}}
      </div>
[[ endif; ]]
    </div>
  </div>
</div>
