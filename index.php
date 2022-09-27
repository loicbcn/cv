<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ol@v7.1.0/ol.css">
        <script src="https://cdn.jsdelivr.net/npm/ol@v7.1.0/dist/ol.js"></script>
        <script src="https://code.highcharts.com/10.2.1/highcharts.js"></script>
        <script src="https://code.highcharts.com/10.2.1/modules/sankey.js"></script>
        <script src="https://code.highcharts.com/10.2.1/modules/accessibility.js"></script>        
        <style>
            .row{
               display:flex;
            }
        </style>
    </head>
    <body>
    <h1>Test</h1>
    <div class="row">
        <div id="cont_map">
            <div id="map" style="width:600px; height:600px"></div>
        </div>
        
        <div id="competences" style="width:600px; height:600px"></div>
    </div>
    <script>
    
const colors = {
        'Toulouse': 'rgba(157, 107, 85,.4)',
        'Barcelone': 'rgba(69, 1, 22, 1)',
        'Aix-en-Provence': 'rgba(164, 124, 211, 1)',
        'Rouen': 'rgba(181, 33, 39,1)',
        'Carrots':'rgba(241, 101, 0,1)',
        'Oasysoft': 'rgba(66, 190, 40,1)',
        'Sopra-Steria':'rgba(196, 2, 41,1)',
        'DDT31':'rgba(60, 91, 164,1)',
        'CETE-Méditerranée': 'rgba(43, 144, 143, 1)',
        'DRE Haute-Normandie': 'rgba(145, 232, 225,1)',
        'SQL' : 'rgba(255, 255, 255, 1)',
        'Frontend' : 'rgba(255, 255, 255, 1)',
        'Backend' : 'rgba(255, 255, 255, 1)',
        'Admin. données' : 'rgba(255, 255, 255, 1)',
        'Géomatique' : 'rgba(255, 255, 255, 1)',
};

const years = {
    'Toulouse': '2017-2022',
    'Barcelone': '2006-2017',
    'Aix-en-Provence': '2001-2006',
    'Rouen': '1996-2001',
    'DDT31' :'2017-2022',
    'Sopra-Steria' :'2015-2017',
    'Carrots': '2011-2015',
    'Oasysoft': '2007-2011',
    'CETE-Méditerranée': '2001-2006',
    'DRE Haute-Normandie': '1996-2001'
}

const tooltipComp = {
    'SQL': `- MySQL<br> - PostgreSQL (+GIS +psql)<br>- Oracle`,
    'Géomatique' : `- QGIS<br>- MapInfo<br>- Arcgis<br>- ogr<br>- Web mapping`,
    'Frontend' : `- Javascript<br>&nbsp;&nbsp;&nbsp;∟vanilla<br>&nbsp;&nbsp;&nbsp;∟jQuery<br>&nbsp;&nbsp;&nbsp;∟OpenLayers<br>&nbsp;&nbsp;&nbsp;∟Highcharts<br>&nbsp;&nbsp;&nbsp;∟Bootstrap)<br>- css (Bootstrap, knacss)<br>- html<br>- markdown`,
    'Backend': `- php<br>&nbsp;&nbsp;&nbsp;∟CodeIgniter<br>&nbsp;&nbsp;&nbsp;∟Api`,
    'Admin. données': `- Traitement de données<br>- Scripts (batch, ogr, psql)<br>- Suite GéoIDE`
    
};

const arbre = Highcharts.chart('competences', {

    title: {
        text: undefined
    },
    accessibility: {
        point: {
            valueDescriptionFormat: '{index}. {point.from} to {point.to}, {point.weight}.'
        }
    },
    series: [
    {       
        animation: true,
        keys: ['from', 'to', 'weight', 'color'],
        levels:[{
            level : 2,
            borderColor: '#000',
            borderWidth:1
        }],
        tooltip: {
            nodeFormatter : function(){
                if ( this.level == 0 ) {
                    return this.name + ': ' + this.sum + ' ans';
                } else if ( this.level == 1 ) {
                    return this.name + ' (' + years[this.name] + ')';
                } else {
                    return '<strong>' + this.name + '</strong><br>' + tooltipComp[this.name];
                }
            },
            pointFormatter: function(){
                return this.from + ': ' + this.to;
            }
        },
        data: [
            ['Toulouse', 'DDT31', 5, colors['Toulouse']],
            ['Barcelone', 'Sopra-Steria', 2.5, colors['Barcelone']],
            ['Barcelone', 'Carrots', 4],
            ['Barcelone', 'Oasysoft', 4],
            ['Aix-en-Provence', 'CETE-Méditerranée', 4, colors['Aix-en-Provence']],            
            ['Rouen', 'DRE Haute-Normandie', 4, colors['Rouen']],
            
            
            ['DDT31', 'SQL', 4, colors['DDT31']],
            ['DDT31', 'Géomatique', 3],
            ['DDT31', 'Admin. données', 2],
            ['DDT31', 'Backend', 4],
            ['DDT31', 'Frontend', 5],
            ['Sopra-Steria', 'Frontend', 4],
            ['Sopra-Steria', 'SQL', 3],  
            ['Sopra-Steria', 'Backend', 5],  
            
            ['Carrots', 'Frontend', 5, colors['Carrots']],
            ['Carrots', 'Backend', 5],
            ['Carrots', 'SQL', 3],

            ['Oasysoft', 'Frontend', 5, colors['Oasysoft']],
            ['Oasysoft', 'Backend', 4],
            ['Oasysoft', 'SQL', 1],
            ['CETE-Méditerranée', 'Géomatique', 5, colors['CETE-Méditerranée']],
            ['CETE-Méditerranée', 'Admin. données', 5, colors['CETE-Méditerranée']],
            ['CETE-Méditerranée', 'Backend', 3, colors['CETE-Méditerranée']],
            ['CETE-Méditerranée', 'Frontend', 3, colors['CETE-Méditerranée']],

            ['DRE Haute-Normandie', 'Admin. données', 5, colors['DRE Haute-Normandie']],
            ['DRE Haute-Normandie', 'SQL', 2, colors['DRE Haute-Normandie']],

        ],
        
        nodes: [{
            id: 'Toulouse',
            color: colors['Toulouse'],
        }, {
            id: 'Barcelone',
            color: colors['Barcelone'],
        }, {
            id: 'Aix-en-Provence',
            color: colors['Aix-en-Provence'],
        }, {
            id: 'Rouen',
            color: colors['Rouen'],
        },{
            id: 'DDT31',
            color: colors['DDT31']   
        },{
            id: 'Sopra-Steria',
            color: colors['Sopra-Steria'],
            offsetHorizontal:-20            
        },{
            id: 'Carrots',
            color: colors['Carrots'],
            offsetHorizontal:-40
        },{
            id: 'Oasysoft',
            color: colors['Oasysoft'],
            offsetHorizontal:-60
        },{
            id: 'CETE-Méditerranée',
            color: colors['CETE-Méditerranée'],
            offsetHorizontal:-80
        },{
            id: 'DRE Haute-Normandie',
            color: colors['DRE Haute-Normandie'],
            offsetHorizontal:-100
        },{
            id: 'SQL',
            color: colors['SQL'],
        },{
            id: 'Frontend',
            color: colors['Frontend'],
        },{
            id: 'Backend',
            color: colors['Backend'],
        },{
            id: 'Géomatique',
            color: colors['Géomatique'],
        },{
            id: 'Admin. données',
            color: colors['Admin. données'],
        }      
        
        ],
        type: 'sankey',
        name: ''
    }]

}, function(chart) {
        chart.renderer.button('Retour', 10, 10, function() {
            showAllChart();
        }, {
            'id': 'resetbutton',
            'stroke-width': 1,
            stroke: 'silver',
            fill: '#E0E0E0',
            height: 11,
            r: 0,
            zIndex: 10
        }, {
            fill: '#bada55',
        }).css({
            'font-weight': 'bold'
        }).addClass('btn').add();
});    

document.getElementById('resetbutton').style.display = 'none';

let tree = [];
for ( let i in arbre.series[0].data ) {
    tree.push(arbre.series[0].data[i]['options']);
} 

const styleFunction = function (feature) {
    const geometry = feature.getGeometry();
    const styles = [];
    const points = geometry.getCoordinates();
    
    const dp = points[Math.round(points.length /2) - 1];
    const adp = points[Math.round(points.length /2) - 3];
   
    const dx = dp[0] - adp[0];
    const dy = dp[1] - adp[1];

    const rotation = Math.atan2(dy, dx);
   
    styles.push(
      new ol.style.Style({
        geometry: new ol.geom.Point(dp),
        image: new ol.style.Icon({
          src: 'img/letters_v.svg',
          anchor: [0.5, 0.5],
          scale: 0.08,
          rotateWithView: true,
          rotation: -rotation- Math.PI/2,
          color: 'rgba(0, 0, 0, 1)',
          opacity: .4,
        }),
      })
    );
    
    styles.push(
        // linestring
        new ol.style.Style({
          stroke: new ol.style.Stroke({
            color: 'rgba(200,0,0,.4)',
            width: 6,
          }),
        }),
    );

    return styles;
};

const cities_prop = {
    1:{align:'left', offsetX:10, offsetY:-10},
    2:{align:'right', offsetX:-10, offsetY:-10},
    3:{align:'left', offsetX:10, offsetY:-10},
    4:{align:'left', offsetX:10, offsetY:-10},
    5:{align:'left', offsetX:10, offsetY:-10},
    6:{align:'right', offsetX:-10, offsetY:-10}
};

const __cityMarkerStyle = new ol.style.Style({
    image: new ol.style.Icon({
    opacity: 1,
    src: 'img/pin_position.svg',
    scale: 0.1,
    anchor: [0.5, 0.9],
  }),
});

function cityText(feature, resolution) {
    return new ol.style.Text({
            //scale:1,
            textAlign: cities_prop[feature.get('fid')]['align'],
            baseline: 'Middle',
            font: '14px Arial',
            text: resolution > 10000 ? '' : feature.get('nom'), 
            fill: new ol.style.Fill({color: '#000000'}),
            stroke: new ol.style.Stroke({color: '#ffffff', width: 2}),
            offsetX: cities_prop[feature.get('fid')]['offsetX'],
            offsetY: cities_prop[feature.get('fid')]['offsetY'],
        });
}

function selectedcityMarkerStyleFunction(feature, resolution){
    return new ol.style.Style({
        image: new ol.style.Icon({
            opacity: 1,
            src: 'img/pin_position.svg',
            color: '#ff0000',
            scale: 0.15,
            anchor: [0.5, 0.9]
        }),
        text : cityText(feature, resolution)
    });
}

function cityMarkerStyleFunction(feature, resolution){
    return new ol.style.Style({
        image: new ol.style.Icon({
            opacity: 1,
            src: 'img/pin_position.svg',
            color: '#b835ff',
            scale: 0.1,
            anchor: [0.5, 0.9]
        }),
        text : cityText(feature, resolution)
    });
}

const parcoursStyle = new ol.style.Style({
        stroke: new ol.style.Stroke({
        color: 'rgba(200,0,0,.4)',
        width: 8
    })
});


const stamen_watercolor = new ol.layer.Tile({
    source: new ol.source.XYZ({
        url: 'https://stamen-tiles.a.ssl.fastly.net/watercolor/{z}/{x}/{y}.jpg'
    })    
});
 
const villes = new ol.layer.Vector({
  source: new ol.source.Vector({
    url: 'data/cities.json',
    format: new ol.format.GeoJSON()
  }),
  style: cityMarkerStyleFunction// cityMarkerStyle
});

const parcours = new ol.layer.Vector({
  source: new ol.source.Vector({
    url: 'data/parcours.json',
    format: new ol.format.GeoJSON()
  }),
  style : styleFunction //parcoursStyle
});

const map = new ol.Map({
    background: 'yellow',
    /*controls: ol.control.defaults().extend([
        new ol.control.FullScreen()
    ]),*/
    target: 'map',
    view: new ol.View({
      zoom: 6,
      maxZoom: 8,
      minZoom: 4,
      center: [172101,5759638.14],
      extent: [ -1118897.6, 4538639.6, 1463099.6, 7120636.7 ]
    }),
    layers: [ stamen_watercolor, parcours, villes ]
});

map.on('singleclick', function (e) {
    villes.getSource().forEachFeature(function(feature) {
        feature.setStyle(cityMarkerStyleFunction);
    });
    var feature = map.forEachFeatureAtPixel(e.pixel, function(feature, layer) {
        if (layer === villes) {
            feature.setStyle(selectedcityMarkerStyleFunction);
            setChart(feature.getProperties().nom);
        }
    });
});

map.on("pointermove", function (e) {
    var hit = this.forEachFeatureAtPixel(e.pixel, function(feature, layer) {
        if (layer === villes) {
            return true;
        }
    }); 
    if (hit) {
        this.getTargetElement().style.cursor = 'pointer';
    } else {
        this.getTargetElement().style.cursor = '';
    }
});

function setChart(nom){
    
    document.getElementById('resetbutton').style.display = 'block';
    
    let tokeep = {'data':[]};
    let tos = [];

    for ( let t in tree) {
        if ( tree[t]['from'] == nom) {
            tokeep['data'].push([
                tree[t]['from'], tree[t]['to'], tree[t]['weight']
            ]);
            tos.push(tree[t]['to']);
        }
    }
    
    for ( let t in tree) {
        if ( tos.indexOf(tree[t]['from']) != -1 ) {
            tokeep['data'].push([
                tree[t]['from'], tree[t]['to'], tree[t]['weight']
            ]);
        }
    }   
   
    arbre.update({
        series: tokeep
    });
}

function showAllChart() {
    document.getElementById('resetbutton').style.display = 'none';
    arbre.update({
        series: {'data': tree}
    });
}

    </script>
    </body>
</html>