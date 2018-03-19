$(function() {

  var polar_to_cartesian, svg_circle_arc_path, animate_arc;

  polar_to_cartesian = function(cx, cy, radius, angle) {
    var radians;
    radians = (angle - 90) * Math.PI / 180.0;
    return [Math.round((cx + (radius * Math.cos(radians))) * 100) / 100, Math.round((cy + (radius * Math.sin(radians))) * 100) / 100];
  };

  svg_circle_arc_path = function(x, y, radius, start_angle, end_angle) {
    var end_xy, start_xy;
    start_xy = polar_to_cartesian(x, y, radius, end_angle);
    end_xy = polar_to_cartesian(x, y, radius, start_angle);
    return "M " + start_xy[0] + " " + start_xy[1] + " A " + radius + " " + radius + " 0 0 0 " + end_xy[0] + " " + end_xy[1];
  };

  animate_arc = function(ratio, svg, perc) {
    var arc, center, radius, startx, starty;
    arc = svg.path('');
    center = 500;
    radius = 450;
    startx = 0;
    starty = 450;
    return Snap.animate(0, ratio, (function(val) {
      var path;
      arc.remove();
      path = svg_circle_arc_path(500, 500, 450, -90, val * 180.0 - 90);
      arc = svg.path(path);
      arc.attr({
        class: 'data-arc'
      });
      perc.text(Math.round(val * 100) + '%');
    }), Math.round(2000 * ratio), mina.easeinout);
  };

  $('.metric').each(function() {
    var ratio, svg, perc;
    ratio = $(this).data('ratio');
    svg = Snap($(this).find('svg')[0]);
    perc = $(this).find('text.percentage');
    animate_arc(ratio, svg, perc);
  });
});