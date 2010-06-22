$(document).ready(function() {

	// notice the 'curviness' argument to this Bezier curve.  the curves on this page are far smoother
	// than the curves on the first demo, which use the default curviness value.
	jsPlumb.DEFAULT_CONNECTOR = new jsPlumb.Connectors.Bezier(100);
	jsPlumb.DEFAULT_DRAG_OPTIONS = { cursor: 'pointer', zIndex:2000 };
	jsPlumb.DEFAULT_PAINT_STYLE = { strokeStyle:'black' };
	jsPlumb.DEFAULT_ENDPOINT_STYLE = { radius:4 };
        jsPlumb.DEFAULT_DRAG_OPTIONS = { cursor: 'crosshair' };


});
