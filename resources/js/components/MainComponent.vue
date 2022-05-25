<template>
	<div class="container-sm">
		<div class="d-flex p-5">
			<h3 class="mx-auto">URL Shorter</h3>
		</div>
		<div class="shadow p-5">
			<div class="input-group">
				<input class="form-control w-50" placeholder="Enter your link" v-model="formData.originalUrl">
				<input class="form-control" placeholder="Enter your folder name" v-model="formData.folder">
				<button class="btn btn-primary" @click="fetchLink">
					Get URL
				</button>
			</div>
			<div v-if="isLoading" class="text-center mt-2">
				<div class="spinner-border spinner-border-sm"></div>
				<div>Please wait...</div>
			</div>
			<div v-if="shortUrl && !isLoading" class="text-center mt-2">
				<div>Your link is:</div>
				<a class="short-url" :href="shortUrl">{{ shortUrl }}</a>
			</div>
			<div v-else-if="error && !isLoading" class="text-center text-danger mt-2">
				<div>{{ error }}</div>
			</div>
		</div>
	</div>
</template>

<script>
import {isEmpty} from "lodash";

export default {
	name: "MainComponent",
	methods: {
		fetchLink: function () {
			if (!this.formData.originalUrl) return

			if (isEmpty(this.formData.folder))
				delete this.formData['folder']

			this.isLoading = true
			axios.post('/api/generate-url', this.formData).then(response => {
				this.shortUrl = response.data.shortUrl
				this.isLoading = false
			}).catch(reason => {
				this.error = reason.response.data.message
				this.isLoading = false
				this.shortUrl = null
			})
		}
	},
	data() {
		return {
			formData: {
				originalUrl: null,
				folder: null
			},
			shortUrl: null,
			isLoading: false,
			error: null
		}
	}
}
</script>

<style scoped>

</style>