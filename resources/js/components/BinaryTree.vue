<template>
  <div class="">
    <div style="flex-wrap: wrap; display: flex; justify-content: center">
      <section
        style="
          top: 110px;
          left: 60px;
          display: inline-block;
          max-width: 100px;
          height: 80px;
          border-left: 2px solid #aaa;
          transform: rotate(45deg);
          position: relative;
          flex: 1;
        "
      ></section>
      <img
        :src="binary.c.Photo"
        data-toggle="tooltip"
        data-placement="bottom"
        title=""
        class="img-circle"
        alt="binary[0].fullName "
        style="max-width: 120px; height: 120px; flex: 1"
        :data-original-title="binary.c.fullName"
      />

      <section
        style="
          top: 110px;
          left: -60px;
          display: inline-block;
          max-width: 100px;
          height: 80px;
          border-right: 2px solid #aaa;
          transform: rotate(-45deg);
          position: relative;
          flex: 1;
        "
      ></section>
    </div>
    <div style="flex-wrap: wrap; display: flex; justify-content: center">
      <section
        style="
          top: 80px;
          left: 20px;
          display: inline-block;
          max-width: 30px;
          height: 50px;
          border-left: 2px solid #aaa;
          transform: rotate(35deg);
          position: relative;
          flex: 1;
        "
      ></section>
      <a href="#" onclick="ver_user_arbol('74934732');">
        <img
          v-if="binary.hasOwnProperty('a')"
          :src="binary.a.user_membreship.Photo"
          data-toggle="tooltip"
          data-placement="bottom"
          title=""
          class="img-circle"
          alt="User Image"
          style="max-width: 80px; height: 80px; flex: 1"
          :data-original-title="binary.a.user_membreship.fullName"
        />
      </a>
      <section
        style="
          top: 80px;
          left: -20px;
          display: inline-block;
          max-width: 30px;
          height: 50px;
          border-right: 2px solid #aaa;
          transform: rotate(-35deg);
          position: relative;
          flex: 1;
        "
      ></section>
      &nbsp;
      <section style="max-width: 170px; flex: 1"></section>
      <section
        style="
          top: 80px;
          left: 20px;
          display: inline-block;
          max-width: 30px;
          height: 50px;
          border-left: 2px solid #aaa;
          transform: rotate(35deg);
          position: relative;
          flex: 1;
        "
      ></section>

      <a href="#" onclick="ver_user_arbol('didi');">
        <img
          v-if="binary.hasOwnProperty('b')"
          :src="binary.b.user_membreship.Photo"
          data-toggle="tooltip"
          data-placement="bottom"
          title=""
          class="img-circle"
          alt="User Image"
          style="max-width: 80px; height: 80px; flex: 1"
          :data-original-title="binary.b.user_membreship.fullName"
        />
      </a>
      <section
        style="
          top: 80px;
          left: -20px;
          display: inline-block;
          max-width: 30px;
          height: 50px;
          border-right: 2px solid #aaa;
          transform: rotate(-35deg);
          position: relative;
          flex: 1;
        "
      ></section>
    </div>
    <br /><br /><br />
    <div style="flex-wrap: wrap; display: flex; justify-content: center">
      <a href="#" onclick="ver_user_arbol('prueba');">
        <img
          v-if="binary.hasOwnProperty('aa')"
          :src="binary.aa.user_membreship.Photo"
          data-toggle="tooltip"
          data-placement="bottom"
          title=""
          class="img-circle"
          alt="User Image"
          style="max-width: 80px; height: 80px; flex: 1"
          data-original-title="Una Prueba Una Prueba"
        />
      </a>

      <section style="max-width: 40px; display: inline-block; flex: 1"></section>
      <section style="max-width: 80px; display: inline-block; flex: 1">&nbsp;</section>
      <a href="#" onclick="ver_user_arbol('prueba');">
        <img
          v-if="binary.hasOwnProperty('ab')"
          :src="binary.ab.user_membreship.Photo"
          data-toggle="tooltip"
          data-placement="bottom"
          title=""
          class="img-circle"
          alt="User Image"
          style="max-width: 80px; height: 80px; flex: 1"
          data-original-title="Una Prueba Una Prueba"
        />
      </a>
      &nbsp;
      <section style="max-width: 120px; flex: 1"></section>
      <a href="#" onclick="ver_user_arbol('alba');">
        <img
          v-if="binary.hasOwnProperty('ba')"
          :src="binary.ba.user_membreship.Photo"
          data-toggle="tooltip"
          data-placement="bottom"
          title=""
          class="img-circle"
          alt="User Image"
          style="max-width: 80px; height: 80px; flex: 1"
          data-original-title="Alba Alba"
        />
      </a>
      <section style="max-width: 80px; display: inline-block; flex: 1">&nbsp;</section>
      <section style="max-width: 40px; display: inline-block; flex: 1"></section>
      <a href="#" onclick="ver_user_arbol('alba');">
        <img
          v-if="binary.hasOwnProperty('bb')"
          :src="binary.bb.user_membreship.Photo"
          data-toggle="tooltip"
          data-placement="bottom"
          title=""
          class="img-circle"
          alt="User Image"
          style="max-width: 80px; height: 80px; flex: 1"
          data-original-title="Alba Alba"
        />
      </a>
    </div>
  </div>
</template>

<script>
import api from '../api/api';

export default {
  data() {
    return {
      binary: [],
      currentUser: {},
    };
  },

  mounted() {
    this.get_binary_tree();
    this.currentUser = this.binary.c;
  },

  methods: {
    get_binary_tree() {
      api.get(`/listbinary`).then((response) => {
        this.binary = response.data;
      });
    },
  },
};
</script>

<style>
</style>