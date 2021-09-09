<template>
  <div class="col-lg-12 col-md-12 col-12">
    <div id="tree" />
  </div>
</template>

<script>
  import OrgChart from '@balkangraph/orgchart.js';
import api from '../api/api';
export default {
  name: 'TreeComponent',
  data() {
    return {
      users: [],
    };
  },
  created: function () {
    this.listUsers();
  },
  methods: {
    loadTree() {
      this.$nextTick(function () {
        var chart = new OrgChart(document.getElementById('tree'), {
          mouseScrool: OrgChart.action.scroll,
          template: 'ula',

          nodeBinding: {
            field_0: 'name',
            img_0: 'Photo',
          },
          nodes: this.users,
        });
      });
    },
    listUsers() {
      api.get(`/viewTree`).then((response) => {
        this.users = response.data;
        this.loadTree();
      });
    },
  },
};
</script>

<style>
#tree {
  width: 100%;
  height: 100%;
}
</style>