<template>
  <div class="">
    <section v-if="!loading">
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
        <a v-if="binary.hasOwnProperty('c')" @click="viewUser(binary.c.user)">
          <img
            :src="binary.c.Photo"
            data-toggle="tooltip"
            data-placement="bottom"
            title=""
            class="img-circle"
            alt="binary.c.fullName "
            style="max-width: 120px; height: 120px; flex: 1"
            :data-original-title="binary.c.fullName"
          />
        </a>
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
        <a v-if="binary.hasOwnProperty('a')" @click="viewUser(binary.a.user_membreship.user)">
          <img
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

        <a v-if="binary.hasOwnProperty('b')" @click="viewUser(binary.b.user_membreship.user)">
          <img
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
        <a v-if="binary.hasOwnProperty('aa')" @click="viewUser(binary.aa.user_membreship.user)">
          <img
            :src="binary.aa.user_membreship.Photo"
            data-toggle="tooltip"
            data-placement="bottom"
            title=""
            class="img-circle"
            alt="User Image"
            style="max-width: 80px; height: 80px; flex: 1"
            :data-original-title="binary.aa.user_membreship.fullName"
          />
        </a>

        <section style="max-width: 40px; display: inline-block; flex: 1"></section>
        <section style="max-width: 80px; display: inline-block; flex: 1"></section>
        <a v-if="binary.hasOwnProperty('ab')" @click="viewUser(binary.ab.user_membreship.user)">
          <img
            :src="binary.ab.user_membreship.Photo"
            data-toggle="tooltip"
            data-placement="bottom"
            title=""
            class="img-circle"
            alt="User Image"
            style="max-width: 80px; height: 80px; flex: 1"
            :data-original-title="binary.ab.user_membreship.fullName"
          />
        </a>
        &nbsp;
        <section style="max-width: 120px; flex: 1"></section>
        <a v-if="binary.hasOwnProperty('ba')" @click="viewUser(binary.ba.user_membreship.user)">
          <img
            :src="binary.ba.user_membreship.Photo"
            data-toggle="tooltip"
            data-placement="bottom"
            title=""
            class="img-circle"
            alt="User Image"
            style="max-width: 80px; height: 80px; flex: 1"
            :data-original-title="binary.ba.user_membreship.fullName"
          />
        </a>
        <section style="max-width: 80px; display: inline-block; flex: 1">&nbsp;</section>
        <section style="max-width: 40px; display: inline-block; flex: 1"></section>
        <a v-if="binary.hasOwnProperty('bb')" @click="viewUser(binary.bb.user_membreship.user)">
          <img
            :src="binary.bb.user_membreship.Photo"
            data-toggle="tooltip"
            data-placement="bottom"
            title=""
            class="img-circle"
            alt="User Image"
            style="max-width: 80px; height: 80px; flex: 1"
            :data-original-title="binary.bb.user_membreship.fullName"
          />
        </a>
      </div>
    <modal-user :user="user_membreship"> </modal-user>
    </section>
    <custom-spinner v-else></custom-spinner>
  </div>
</template>

<script>
import api from '../api/api';
import CustomSpinner from '../common/custom-spinner/CustomSpinner.vue';
export default {
  components: { CustomSpinner },

  data() {
    return {
      loading: false,
      binary: [],
      user_membreship: {
        account_type: {},
      },
    };
  },

  mounted() {
    this.get_binary_tree();
  },

  methods: {
    get_binary_tree() {
      this.loading = true;
      api.get(`/listbinary`).then((response) => {
        this.binary = response.data;
        this.loading = false;
      });
    },

    viewUser(user) {
      api
        .get(`/user-membreship/get-data-user/${user}`)
        .then((response) => {
          this.user_membreship = response;
          $(`#viewUser`).modal('show');
        })
        .catch((error) => {
          // console.log(error);
        });
    },
  },
};
</script>

<style>
</style>