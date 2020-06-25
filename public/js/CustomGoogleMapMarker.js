function CustomMarker(latlng, map, args, list, path) {
	this.latlng = latlng;	
	this.args = args;
	this.list = list;
	this.path = path;
	this.setMap(map);
}

CustomMarker.prototype = new google.maps.OverlayView();

CustomMarker.prototype.draw = function() {
	
	var self = this;
	
	var div = this.div;
	
	if (!div) {
	
		div = this.div = document.createElement('div');
		
		div.className = 'marker';
		div.style.cssText = "border: 1px solid #f62c0f; margin-top: 8px; background: rgba(224, 224, 224, 0.73); padding: 5px;z-index:999;width:50px;position:fixed;";
		div.innerHTML = "<a style='display: none;' href='/rooms/"+this.list.id+"'><p><img src='"+this.path+''+this.list.photo+"' style='width:238px'/></p><h4 style='word-wrap: break-word;'>"+this.list.name+"</h4></a><p>"+this.list.symbol+ '' + this.list.price +"</p>";
		// var p = $("<p>" + lists[i].symbol + lists[i].price + "</p>");
		// $(boxText).append(p);
		
		// div.style.position = 'absolute';
		// div.style.cursor = 'pointer';
		// div.style.width = '20px';
		// div.style.height = '20px';
		// div.style.background = 'blue';
		
		if (typeof(self.args.marker_id) !== 'undefined') {
			div.dataset.marker_id = self.args.marker_id;
		}
		
		google.maps.event.addDomListener(div, "click", function(event) {
			//alert('You clicked on a custom marker!');
			var a = this.childNodes;	
			if(a[0].style.display == 'none'){
				a[0].style.display = 'inline';
			} else {
				a[0].style.display = 'none';
			}

			// console.log(a);
			// console.log(self);
			// console.log(this.childNodes);
			google.maps.event.trigger(self, "click");
		});
		
		var panes = this.getPanes();
		panes.overlayImage.appendChild(div);
	}
	
	var point = this.getProjection().fromLatLngToDivPixel(this.latlng);
	
	if (point) {
		div.style.left = (point.x - 10) + 'px';
		div.style.top = (point.y - 20) + 'px';
	}
};

CustomMarker.prototype.remove = function() {
	if (this.div) {
		this.div.parentNode.removeChild(this.div);
		this.div = null;
	}	
};

CustomMarker.prototype.getPosition = function() {
	return this.latlng;	
};