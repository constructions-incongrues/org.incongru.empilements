import React from "react"
import { graphql } from "gatsby"
import Layout from "../components/layout"

const artists = [];

export default ({ data }) => (
  <Layout>
    {data.allDirectusEmpilement.edges.map(({ node }) => (
      <div class="release box">
        <a href={'/' + node.directusId} title="Écouter la compilation">
          <img src={"http://api.empilements.localhost/uploads/_/originals/" + node.cover.filename} />
        </a>
      <h2 class="contributorcatalog">
        {node.published_on}
        <span class="pink"> // </span>
        { node.curators.join(', ') }
      </h2>
      <h1 class="releasenamecatalog">{node.title}</h1>
      <p class="cataloglink"><a href={'/' + node.directusId} title="Écouter la compilation"> écouter</a> ♪  <a href={'/' + node.directusId} title="Télécharger la compilation">télécharger</a> </p>
      <div class="details">
        <p>
          <a href={'/' + node.directusId} title="Écouter la compilation">
            <span class="pink">Avec :</span>
            { node.tracks.join(', ') }
          </a>
        </p>
      </div>
    </div>
    ))}
  </Layout>
)

export const query = graphql`
  query {
    allDirectusEmpilement(sort:{fields:[published_on], order:DESC}) {
      edges {
        node {
          directusId
          title
          published_on
          cover {
            filename
          },
          curators {
            name
          }
          tracks {
            artists {
              name
            }
          }
        }
      }
    }
  }
`
