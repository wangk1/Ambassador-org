angular.module('ui.bootstrap.demo', ['ui.bootstrap']);
var home=angular.module('ui.bootstrap.demo').controller('HomeCtrl', function ($scope,$carousel) {
  $scope.interval = 6000;
  var slides = $scope.slides = [];
  $scope.addSlide = function() {
    var newWidth = slides.length;
    
    for(var i=0;i<$carousel.length;i++) 
    slides.push($carousel[i]);
  };

  $scope.addSlide();
});

home.factory("$carousel",function() {

	return [
		{ 
			image: 'img/0.jpg',
		      title:"The New Campus Ambassador Website",
		      text: "UNC's own 3 students have announced an ambassador website."
		}, 
		{ 
			image: 'img/1.jpg',
		      title:"Google Ambassadors Landing",
		      text: "Google announces brand new opening for campus ambassadors."
		}, 	
		{ 
			image: 'img/2.jpg',
		      title:"Microsoft Ambassadors Landing",
		      text: "Redmond announces the expansion of its campus ambassadors network."
		}, 	
		{ 
			image: 'img/3.jpg',
		      title:"Facebook Webassadors",
		      text: "The social media outsources its campus networking to actual people."
		}, 	
	];

});
