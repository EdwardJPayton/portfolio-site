function newFunction() {
  $l('executed about.js');

  var getGithub = function() {
  	return {
  		init: function() {
  			getGithub.loadRepos();
  		},
  		loadRepos: function() {
  			  reqwest({
		      method: 'get',
		      url: 'https://api.github.com/users/edwardjpayton/repos',
		      type: 'json',
		      success: function(data) {
		        for(i in data) {
		        	var name = data[i].name,
		      				description = data[i].description || 'No description',
		      				url = data[i].html_url,
		      				updatedAt = data[i].updated_at;

		      		var newLi = document.createElement('li');
		      		var liContent = '<a href="' + url + '" tagret="_blank">' + '<h4>' + name + '</h4></a>' + '<p>' + description + '</p>' + '<p>' + updatedAt + '</p>';
		      		newLi.innerHTML = liContent;
		      		$id('apiGithub').appendChild(newLi);
		        }
		        $id('repoTotal').innerHTML = data.length;
		      }
		    });
  		}
  	}
  }();
  getGithub.init();


  /*
  // Removed because local CORs blocked - havent been able to fix
  function getInstagram() {
		var instaUrl = 'https://api.instagram.com/v1/users/self/media/recent/?access_token=2141166308.9960534.79b7575e25134ef5b6a6f8b288519a3e',
				number = 6;

		reqwest({
			method: 'get',
			url: instaUrl,
			type: 'json',
			success: function(data) {
				for(i in data) {
					console.log(i);
				}
			}
		});
	};
	getInstagram(); 
	*/


}
newFunction();