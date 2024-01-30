%% views/header.html %%

<div class="row">
  <div class="col-lg-12">
    <h2>Recent posts</h2>
[[ foreach ($posts as $post) : ]]
  %% views/post_summary.php %%
[[ endforeach; ]]
  </div>
</div>

[[ if (isLoggedIn()): ]]
<div class="row mt-4">
  <div class="col-lg-12">
  <button onclick="get('@@post/add@@')" class="btn btn-primary mr-1 d-flex justify-content-center align-content-between" ><span class="material-icons">add_circle_outline</span>&nbsp;Add a post</button>
  </div>
</div>
[[ endif; ]]

%% views/footer.html %% 