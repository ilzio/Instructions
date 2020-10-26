Basic Install 

	mkdir hello-next
	cd hello-next
	npm init -y
	npm install --save react react-dom next
	mkdir pages

Then open the package.json file in the hello-next directory and replace scripts with the following:

	"scripts": {
	  "dev": "next",
	  "build": "next build",
	  "start": "next start"
	}

File Based Navigation

* In pages components have to be created as single files, each page will then become an endpoint ex: 

	-index.js
	-about.js
	-...

 * In order to enable navigation: 

	import Link from 'next/link'

	<Link href="/about">
		<a>About page</a>
	</Link>
	
the only requirement for components placed inside <Link /> is that they should accept an onClick prop.

Pass data with query string:

pass data in Link href

	const PostLink = props => (
	  <li>
	    <Link href={`{post?title=${props.title}`}>
	      <a>{props.title}</a>
	    </Link>
	  </li>
	)


DYNAMIC PAGES & CLEAN URL

* Create target page / folder whose name is contained in square brackets "[]" ex: [id].js
	the name between brackets will be the name of the query param received by the page, in this case "id"

	Link to it as follows:

	    <Link 
			href="/posts/[id]" 
			as={`/posts/${props.id}`} 
		>
	      <a>{props.id}</a>
	    </Link>

	href = is the actual path inside pages directory  
	as = the slug shown in the browser URL bar
	

* Inside the page, the query param can be retrieved using the useRouter Hook

	import { useRouter } from 'next/router';

	const router = useRouter();
	const {propReceived} = router.query // same as const propReceived = router.query.propReceived 
	



SERVER SIDE RENDERING:

* getInitialProps is an async function that retrieves data before a component is mounted and rendered, sending the page with the data already populated from the server (retrieve data will be part of the "props".

	Component.getInitialProps = async function (context) {
		const res = await fetch('https://api.tvmaze.com/search/shows?q=batman');
		const data = await res.json();

		return {
			dataRetrieved: data.map(entry => entry.show)
		};
	};


getInitialProps receives as paramenter context object with the following properties:

	pathname - path section of URL
	query - query string section of URL parsed as an object
	asPath - String of the actual path (including the query) shows in the browser
	req - HTTP request object (server only)
	res - HTTP response object (server only)
	err - Error object if any error is encountered during the rendering

*On the first load the function is executed on the server, on second load it is executed on the client. 
*getInitialProps enables server-side rendering, disabling automatic static optimization

* Since Next.js 9.3 it is recommended to use getStaticProps or getServerSideProps instead of getInitialProps.

	* getServerSideProps()

Gets called on every request: use if need to pre-render a page whose data must be fetched at request time. 
	
	export async function getServerSideProps() {
		const res = await fetch(`https://.../data`)
		const data = await res.json()

		return { 
			props: { data } 
		}
	}

 STATIC OPTIMIZATION

* getStaticProps

pre-renders page at build time using the props returned by getStaticProps.

	export async function getStaticProps(context) {
		return {
			props: {}, // will be passed to the page component as props
		}
	}

context paramenter contains 

	params - route parameters for pages using dynamic routes
	preview - true if page is preview mode, undefined otherwise
	previewData - contains preview data set by setPreviewData

getStaticProps should return an object with:

    props - [required] object with the props that will be received by the page component 
    revalidate - [optional] amount in seconds after which a page re-generation can occur

* getStaticPatch 

If a page has dynamic routes and uses getStaticProps it needs to define a list of paths that have to be rendered to HTML at build time. Next.js will statically pre-render all the paths specified by getStaticPaths.

Must return an object with following keys [ both required ]:
	- paths - determines which paths will be pre-rendered (the value for each params must match the parameters used in the page name)
	- fallback  

Example for a pages/posts/[id].js: Next.js will statically generate posts/1 and posts/2 at build time using the page component in pages/posts/[id].js. 


	export async function getStaticPaths() {
		return {
			paths: [
				{ 
					params: { id: '1 } 
					params: { id: '2 } 
				} 
			],
			fallback: false
		};
	}
	

Next.js will statically generate posts/1 and posts/2 at build time using the page component in pages/posts/[id].js. 





