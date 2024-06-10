<template>
  <div>
    <div>
      <form action="">
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
import { useNuxtApp } from "#app";
// definePageMeta({
//   middleware: "guest",
// });

const { $sanctumAuth } = useNuxtApp();
const router = useRouter();

// フォームデータを保持するためのリファレンス
const email = ref("");
const password = ref("");

const login = async () => {
  await $sanctumAuth.login({
    email: email.value,
    password: password.value,
  });
};
</script>

<style scoped></style>
