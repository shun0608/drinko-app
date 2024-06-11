<template>
  <div>
    <div>
      <form>
        <dl>
          <dt>メールアドレス</dt>
          <dd>
            <input id="email" type="string" v-model="email" />
          </dd>
        </dl>
        <dl>
          <dt>
            <label for="password">パスワード</label>
          </dt>
          <dd><input id="password" type="password" v-model="password" /></dd>
        </dl>
        <button type="button" @click="login">ログイン</button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
const { $sanctumAuth } = useNuxtApp();
const errors = ref([]);

// フォームデータを保持するためのリファレンス
const email = ref("");
const password = ref("");
definePageMeta({
  middleware: "guest",
});

const login = async () => {
  try {
    await $sanctumAuth.login(
      {
        email: email.value,
        password: password.value,
      },
      // optional callback function
      (data) => {
        navigateTo("/", {
          external: true,
        });
      }
    );
  } catch (e) {
    errors.value = e.errors;
    console.log(errors.value);
  }
};
</script>

<style scoped></style>
