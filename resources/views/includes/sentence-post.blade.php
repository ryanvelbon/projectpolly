<div class="sentence-post card mb-3" style="max-width: 18rem;">
  <div class="card-header">
  	<strong>{{ $author->first_name }} {{ $author->last_name }}</strong>
  	<small><em>{{ $author->username }}</em></small>
  </div>
  <div class="card-body">
    <!-- <h5 class="card-title">Success card title</h5> -->
    <p class="card-text">{{ $sentence->body }}</p>
  </div>
  <div class="card-footer">
  	<i class="fas fa-thumbs-up"></i>
	<i class="fas fa-thumbs-down"></i>
	<i class="fas fa-heart"></i>
	<i class="fas fa-bookmark"></i>
	<i class="fas fa-share"></i>
  </div>
</div>