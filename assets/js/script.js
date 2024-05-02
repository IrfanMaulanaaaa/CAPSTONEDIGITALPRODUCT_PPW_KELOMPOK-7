// Initialize map
const map = L.map('map').setView([0, 0], 2);

// Add tile layer
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

// Define color scale
const colorScale = {
    'low': 'green',
    'medium': 'yellow',
    'high': 'red'
};

// Add data to map
data.forEach(item => {
    // Determine color based on energy consumption
    let color;
    if (item['Energy Consumption'] < 100) {
        color = colorScale['low'];
    } else if (item['Energy Consumption'] < 200) {
        color = colorScale['medium'];
    } else {
        color = colorScale['high'];
    }

    // Add circle marker with color based on energy consumption
    L.circleMarker([Math.random() * 160 - 80, Math.random() * 360 - 180], {
        radius: 5,
        fillColor: color,
        fillOpacity: 0.7,
        color: 'black',
        weight: 1
    }).bindPopup(`<b>${item.Entity}</b><br>Energy Consumption: ${item['Energy Consumption']} kWh/person`).addTo(map);
});
