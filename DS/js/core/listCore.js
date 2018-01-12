var node  = function(val, next) {
	this.val = val;
	this.next = next;
};

var list = function() {
	this.first = null;
};

list.prototype.updateData = function() {
	console.log("Display:")
	var t = this.first;
	var data = [], i=1;
	while(t!=null) {
		console.log(t.val);
		data.push({"id": i++, "val": t.val});
		t = t.next;
	}
	viewData = data.slice();
	console.log(viewData);
};

list.prototype.insertLast = function(val) {
	if(this.first==null) {
		this.first = new node(val, null);
		return;
	}
	var t = this.first;
	while(t.next!=null) t = t.next;
	t.next = new node(val, null);
};

list.prototype.deleteLast = function() {
	var t = this.first;
	if(t==null) return;
	if(t.next==null) {
		this.first = null;
		return;
	}
	while(t.next.next!=null) t = t.next;
	t.next = null;
};

list.prototype.insertFirst = function(val) {
	this.first = new node(val, this.first);
};

list.prototype.deleteFirst = function() {
	if(this.first==null) return;
	else if(this.first.next==null) this.first = null;
	else this.first = this.first.next;
};

list.prototype.insertAfter = function(val, av) {
	var t = this.first;
	if(t==null) {
		ml.insertLast(val);
		return;
	}
	while(t.val!=av) {
		if(t.next==null) {
			t.next = new node(val);
			return;
		}
		t = t.next;
	}
	var t2 = t.next;
	var newNode = new node(val);
	newNode.next = t2;
	t.next = newNode;
};

list.prototype.delete = function(val) {
	if(this.first==null) return;
	if(this.first.val==val) this.deleteFirst(val);
	var t = this.first;
	while(t.next!=null) {
		if(t.next.val==val) break;
		t = t.next;
	}
	if (t.next==null) return;
	if (t.next.next==null) t.next = null;
	else t.next = t.next.next;
};

list.prototype.deleteAll = function() {
	this.first = null;
};

list.prototype.len = function() { //Length
	var t = this.first;
	var l = 0;
	while(t!=null) {
		l+=1;
		t = t.next;
	}
	return l;
};



