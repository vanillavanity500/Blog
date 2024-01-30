%% views/header.html %%

<div class="row">
  <div class="col-lg-12">
    <p>Posted on: {{$post['datestamp']}}</p>
  </div>
</div>

[[ if ($post['tags']): ]]
<div class="row">
  <div class="col-lg-12">
    <p>Filed under: {{$post['tags']}}</p>
  </div>
</div>
[[ endif; ]]

<div class="row">
  <div class="col-lg-12">
    <h1>{{$post['title']}}</h1>
  </div>
</div>

<div class="row">
  <div class="col-lg-12">
    {{{nl2br(htmlentities($post['content']))}}}
  </div>
</div>
    
<div class="row mt-4">
  <div class="col-lg-12">
    <div class="form-group">
      <div class="btn-toolbar align-middle">
        <button class="btn btn-secondary mr-1 d-flex justify-content-center align-content-between" onclick="return get('@@index@@')"><span class="material-icons">arrow_back</span>&nbsp;Back</button>

[[ if (isLoggedIn() && $post['user_id'] == $_SESSION['user']['id']): ]]
        <a href="@@post/edit/{{$post['id']}}@@"><button class="btn btn-primary d-flex justify-content-center align-content-between mr-1"><span class="material-icons">edit</span>&nbsp;Edit</button></a>
        <button class="btn btn-danger d-flex justify-content-center align-content-between mr-1" onclick="post('@@post/delete/{{$post['id']}}@@')"><span class="material-icons">delete</span>&nbsp;Delete</button>
[[ endif; ]]

      </div>
    </div>
  </div>
</div>
  
%% views/footer.html %%
