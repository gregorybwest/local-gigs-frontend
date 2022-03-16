<script>
/* global mapboxgl */
export default {
  data: function () {
    return {
      events: [
        { lat: 34.1679947, lng: -118.5337307 },
        { lat: 34.042613, lng: -118.255296 },
      ],
    };
  },
  mounted: function () {
    mapboxgl.accessToken = process.env.VUE_APP_MAPBOX_ACCESS_TOKEN;
    const map = new mapboxgl.Map({
      container: "map", // container ID
      style: "mapbox://styles/mapbox/streets-v11", // style URL
      center: [-118.2437, 34.0522], // starting position [lng, lat]
      zoom: 10, // starting zoom
    });
    console.log(map);
    this.events.forEach((event) => {
      console.log(event);
      const marker1 = new mapboxgl.Marker().setLngLat([event.lng, event.lat]).addTo(map);
      console.log(marker1);
    });
    // Create a default Marker and add it to the map.
  },
};
</script>

<template>
  <div class="map">
    <h2>Local Gigs Test Map</h2>
    <div id="map"></div>
  </div>
</template>

<style>
#map {
  height: 500px;
  width: 100%;
}
</style>
