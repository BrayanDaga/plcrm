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
        <a v-if="binary.hasOwnProperty('c')" @click="viewUser(binary.c.username)">
          <img
            :src="binary.c.photo"
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
        <a v-if="binary.hasOwnProperty('a')" @click="viewUser(binary.a.user.username)">
          <img
            :src="binary.a.user.photo"
            data-toggle="tooltip"
            data-placement="bottom"
            title=""
            class="img-circle"
            alt="User Image"
            style="max-width: 80px; height: 80px; flex: 1"
            :data-original-title="binary.a.user.fullName"
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

        <a v-if="binary.hasOwnProperty('b')" @click="viewUser(binary.b.user.username)">
          <img
            :src="binary.b.user.photo"
            data-toggle="tooltip"
            data-placement="bottom"
            title=""
            class="img-circle"
            alt="User Image"
            style="max-width: 80px; height: 80px; flex: 1"
            :data-original-title="binary.b.user.fullName"
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
        <a v-if="binary.hasOwnProperty('aa')" @click="viewUser(binary.aa.user.username)">
          <img
            :src="binary.aa.user.photo"
            data-toggle="tooltip"
            data-placement="bottom"
            title=""
            class="img-circle"
            alt="User Image"
            style="max-width: 80px; height: 80px; flex: 1"
            :data-original-title="binary.aa.user.fullName"
          />
        </a>

        <section style="max-width: 40px; display: inline-block; flex: 1"></section>
        <section style="max-width: 80px; display: inline-block; flex: 1"></section>
        <a v-if="binary.hasOwnProperty('ab')" @click="viewUser(binary.ab.user.username)">
          <img
            :src="binary.ab.user.photo"
            data-toggle="tooltip"
            data-placement="bottom"
            title=""
            class="img-circle"
            alt="User Image"
            style="max-width: 80px; height: 80px; flex: 1"
            :data-original-title="binary.ab.user.fullName"
          />
        </a>
        &nbsp;
        <section style="max-width: 120px; flex: 1"></section>
        <a v-if="binary.hasOwnProperty('ba')" @click="viewUser(binary.ba.user.username)">
          <img
            :src="binary.ba.user.photo"
            data-toggle="tooltip"
            data-placement="bottom"
            title=""
            class="img-circle"
            alt="User Image"
            style="max-width: 80px; height: 80px; flex: 1"
            :data-original-title="binary.ba.user.fullName"
          />
        </a>
        <section style="max-width: 80px; display: inline-block; flex: 1">&nbsp;</section>
        <section style="max-width: 40px; display: inline-block; flex: 1"></section>
        <a v-if="binary.hasOwnProperty('bb')" @click="viewUser(binary.bb.user.username)">
          <img
            :src="binary.bb.user.photo"
            data-toggle="tooltip"
            data-placement="bottom"
            title=""
            class="img-circle"
            alt="User Image"
            style="max-width: 80px; height: 80px; flex: 1"
            :data-original-title="binary.bb.user.fullName"
          />
        </a>
      </div>
    <modal-user :user="user"> </modal-user>
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
      user: {
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
        .get(`/users/get-data-user/${user}`)
        .then((response) => {
          this.user = response;
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