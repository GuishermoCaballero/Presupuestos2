<template>
  <div>
    <GChart
      type="PieChart"
      :options="options"
      :data="data"
    />
  </div>
</template>

<script>
import { GChart } from "vue-google-charts";

export default {
  name: "App",
  components: {
    GChart
  },
  props: {
    data: Array
  },
  data() {
    return {
      options: {
        width: 700,
        height: 400
      }
    };
  }
};
</script>
