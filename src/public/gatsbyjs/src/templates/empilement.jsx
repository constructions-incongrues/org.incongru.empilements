import React from 'react';
import { graphql } from 'gatsby';

// Basic post component
export default ({ data }) => {
  const empilement = data.directusEmpilement;
  return (
    <div class="grid_8 ">
      <h1 class="contributor">| // infos.date // <span class="pink">//</span> // infos.authors|join(', ') //</h1>
      <h2 class="releasename">// infos.title //</h2>

      <p class="artwork"><img class="cover" src="// app.request.basepath ///var/compilations/// compilation ///cover.gif" /></p>
      <ol class="playlist">
        <li>
          <a class="track" href="// app.request.basepath ///// track.url //">// track.name //</a>
        </li>
      </ol>
    </div>
    <ul class="grid_6 nav-1">
    <li><a href="// app.request.basepath ///var/compilations/// compilation ///empilements_// compilation //.zip" onClick="javascript: _gaq.push(['_trackPageview', '/downloads/// compilation //']);">Télécharger</a> <img src="// app.request.basepath ///assets/pics/play.png" alt="" /></li>
    <li><a href="" class="play">Écouter</a><img src="// app.request.basepath ///assets/pics/v.png" /></li>
    </ul>

    <meta name="description" content="// description //" />
    <meta property="og:title" content="// title //" />
    <meta property="og:type" content="music.album" />
    <meta property="og:locale" content="fr_fr" />
    <meta property="og:description" content="// description //" />
    <meta property="og:image" content="http://empilements.incongru.org/var/compilations/// compilation ///cover.gif" />
    <meta property="og:image" content="http://empilements.incongru.org/img/header.png" />
  );
};

// Query to be ran on build, passes resulting JSON as 'data' prop
export const query = graphql`
  query($id: Int!) {
    directusEmpilement(directusId: { eq: $id }) {
      directusId
      title
      cover {
        filename
      }
      published_on
      curators {
        name
      }
      tracks {
        position
        title
        artists {
          name
        }
      }
    }
  }
`;
