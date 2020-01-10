/*
  Highcharts JS v6.0.1 (2017-10-05)

 (c) 2010-2017 Highsoft AS
 Author: Sebastian Domas

 License: www.highcharts.com/license
*/
(function(b){"object"===typeof module&&module.exports?module.exports=b:b(Highcharts)})(function(b){var t=function(a){var b=a.each,g=a.Series,k=a.addEvent,n=a.fireEvent,d=a.wrap,h={init:function(){g.prototype.init.apply(this,arguments);this.initialised=!1;this.baseSeries=null;this.eventRemovers=[];this.addEvents()},setDerivedData:a.noop,setBaseSeries:function(){var l=this.chart,a=this.options.baseSeries;this.baseSeries=a&&(l.series[a]||l.get(a))||null},addEvents:function(){var a=this,e;e=k(this.chart,
"seriesLinked",function(){a.setBaseSeries();a.baseSeries&&!a.initialised&&(a.setDerivedData(),a.addBaseSeriesEvents(),a.initialised=!0)});this.eventRemovers.push(e)},addBaseSeriesEvents:function(){var a=this,e,b;e=k(a.baseSeries,"updatedData",function(){a.setDerivedData()});b=k(a.baseSeries,"destroy",function(){a.baseSeries=null;a.initialised=!1});a.eventRemovers.push(e,b)},destroy:function(){b(this.eventRemovers,function(a){a()});g.prototype.destroy.apply(this,arguments)}};d(a.Chart.prototype,"linkSeries",
function(a){a.call(this);n(this,"seriesLinked")});return h}(b);(function(a,b){function g(a){return function(m){return Math.floor(m/a)*a}}var k=a.each,n=a.objectEach,d=a.seriesType,h=a.correctFloat,l=a.isNumber,e=a.arrayMax,p=a.arrayMin;a=a.merge;var c={"square-root":function(a){return Math.round(Math.sqrt(a.options.data.length))},sturges:function(a){return Math.ceil(Math.log(a.options.data.length)*Math.LOG2E)},rice:function(a){return Math.ceil(2*Math.pow(a.options.data.length,1/3))}};d("histogram",
"column",{binsNumber:"square-root",binWidth:void 0,pointPadding:0,groupPadding:0,grouping:!1,pointPlacement:"between",tooltip:{headerFormat:"",pointFormat:'\x3cspan style\x3d"font-size:10px"\x3e{point.x} - {point.x2}\x3c/span\x3e\x3cbr/\x3e\x3cspan style\x3d"color:{point.color}"\x3e\u25cf\x3c/span\x3e {series.name} \x3cb\x3e{point.y}\x3c/b\x3e\x3cbr/\x3e'}},a(b,{setDerivedData:function(){var a=this.derivedData(this.baseSeries.yData,this.binsNumber(),this.options.binWidth);this.setData(a,!1)},derivedData:function(a,
f,c){var m=e(a),b=p(a),q={},d=[],r;c=this.binWidth=l(c)?c:(m-b)/f;r=g(c);for(f=r(b);f<=m;f+=c)q[h(f)]=0;k(a,function(a){a=h(r(a));q[a]++});n(q,function(a,m){d.push({x:Number(m),y:a,x2:h(Number(m)+c)})});d.sort(function(a,c){return a.x-c.x});return d},binsNumber:function(){var a=this.options.binsNumber,f=c[a]||"function"===typeof a;return Math.ceil(f&&f(this.baseSeries)||(l(a)?a:c["square-root"](this.baseSeries)))}}))})(b,t);(function(a,b){function g(a){var c=a.length;a=p(a,function(a,c){return a+
c},0);return 0<c&&a/c}function k(a,b){var c=a.length;b=l(b)?b:g(a);a=p(a,function(a,c){c-=b;return a+c*c},0);return 1<c&&Math.sqrt(a/(c-1))}function n(a,b,f){a-=b;return Math.exp(-(a*a)/(2*f*f))/(f*Math.sqrt(2*Math.PI))}var d=a.seriesType,h=a.correctFloat,l=a.isNumber,e=a.merge,p=a.reduce;d("bellcurve","areaspline",{intervals:3,pointsInInterval:3,marker:{enabled:!1}},e(b,{setMean:function(){this.mean=h(g(this.baseSeries.yData))},setStandardDeviation:function(){this.standardDeviation=h(k(this.baseSeries.yData,
this.mean))},setDerivedData:function(){1<this.baseSeries.yData.length&&(this.setMean(),this.setStandardDeviation(),this.setData(this.derivedData(this.mean,this.standardDeviation),!1))},derivedData:function(a,b){var c=this.options.intervals,d=this.options.pointsInInterval,e=a-c*b,c=c*d*2+1,d=b/d,h=[],g;for(g=0;g<c;g++)h.push([e,n(e,a,b)]),e+=d;return h}}))})(b,t)});
