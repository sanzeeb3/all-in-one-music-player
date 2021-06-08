const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const el = wp.element.createElement;
const { ServerSideRender } = wp.components;

registerBlockType( 'music-player/music-player', {
    title: __( 'Music Player', 'music-player' ),
    icon: 'format-audio',
    category: 'common',
    attributes: {
        images : {
            default: [],
            type:   'array',

        }
    },
    edit: function ({ attributes }) {
        return (
            <ServerSideRender
                block="music-player/music-player"
            />
        );
    },
    save( { attributes, className } ) {
        // Gutenberg will save attributes we can use in server-side callback
       return null;
    },
} );