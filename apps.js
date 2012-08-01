


function CalendarApp(context,data) {
    this.context = context;
    this.data = data;
    this.pointer = 0;
  
    this.refresh = function() {
        this.pointer++;
        this.context.find('content').html(this.getHTML());
    }
    this.getHTML = function() {
        
        var calendar = this.data;
        var d = new Date();
        var weekday=new Array(7);
        weekday[0]="Sunday";
        weekday[1]="Monday";
        weekday[2]="Tuesday";
        weekday[3]="Wednesday";
        weekday[4]="Thursday";
        weekday[5]="Friday";
        weekday[6]="Saturday";
        
        var result = '<span class="date">'+ d.getDate() +'</span>';
        result += '<span class="day">'+ weekday[d.getDay()].toUpperCase() +'</span>';
        
        if (typeof(calendar) == "string" ) {
            result += calendar;
        } else {
            result += '<p>Make awesome apps</p>';
            result += '<p>BUILD conference</p>';
            result += '<p>9:00 AM - 11:00 AM</p>';
        }
        result += '<span class="icon"></span>';
        return result;
    }
}

function MailApp(context,data) {
    this.context = context;
    this.data = data;
    this.pointer = 0;
    this.message_nomoremail = 'Woohoo! You\'ve read all the messages in your inbox.';
  
    this.refresh = function() {
        this.pointer++;
        this.context.find('content').html(this.getHTML());
    }
    this.getHTML = function() {
        //var gmail = jQuery.parseJSON(this.data);
        var gmail = this.data;
        if (typeof(gmail) != "object" ) {
            return gmail;
        }
        if (gmail.fullcount > 0) {
            if (this.pointer >= gmail.fullcount) {
                this.pointer = 0;
            } 
            if (gmail.fullcount > 1) {
                var entry = jQuery.extend({},gmail.entry[this.pointer]);
            } else {
                var entry = jQuery.extend({},gmail.entry);
            }
            if (entry.title.length > 32) {
                entry.title = entry.title.slice(0,entry.title.indexOf(' ', 28)) + '...';
            }
            if (entry.summary.length > 64) {
                entry.summary = entry.summary.slice(0,entry.summary.indexOf(' ', 50)) + '...';
            }
            var result = '<h2><a href="' + entry.link['@attributes'].href + '" title="' + entry.author.email + '">' + entry.author.name + '</a></h2>';
            result = result + '<p><a href="' + entry.link['@attributes'].href + '">' + entry.title + '</a><br />' + entry.summary + '</p>';
        } else {
            var result = '<h2><a href="' + gmail.link['@attributes'].href + '" title="' + gmail.title + '">Gmail</a></h2>';
            result = result + '<p>' + this.message_nomoremail + '</p>';
        }
        result = result + '<span class="icon"></span>';            
        result = result + '<span class="count">' + gmail.fullcount + '</span>';
        return result;
    }
}

function classExists(c) { 
    c = this.window[c];
    //return typeof(c) === "function"; 
    return typeof(c) === "function" && typeof(c.prototype) == "object" ? true : false; 
} 

