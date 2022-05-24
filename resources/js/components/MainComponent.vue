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
				<a class="nav-link" :href="shortUrl">{{ shortUrl }}</a>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	name: "MainComponent",
	methods: {
		fetchLink: function () {
			if (!this.formData.originalUrl) return

			for (let key in this.formData) {
				if (!(this.formData[key] && this.formData[key].length > 0)) {
					delete this.formData[key]
				}
			}

			this.isLoading = true
			axios.post('/api/generate-url', this.formData).then(response => {
				this.shortUrl = response.data.shortUrl
				this.isLoading = false
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
			isLoading: false
		}
	}
}
</script>

<style scoped>

</style>