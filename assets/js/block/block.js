const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const el = wp.element.createElement;
const { ServerSideRender } = wp.components;
const { InspectorControls } = wp.blockEditor || wp.editor;
const { SelectControl, PanelBody, Placeholder } = wp.components;

registerBlockType( 'all-in-one-music-player/music-player-selector', {
    title: __( 'All in One Music Player', 'all-in-one-music-player' ),
    description: __( 'For best results, plesae view and play the music player in the frontend of your site.', 'all-in-one-music-player' ),
    icon: 'format-audio',
    category: 'widgets',
    keywords: [ 'player', 'music', 'mp3', 'audio' ],
    attributes: {
        theme: {
            type: 'string',
        },
    },
    example: {
        attributes: {
            preview: true,
        },
    },
    edit( props ) {
        const {
                attributes: {
                    theme = '',
                },

            setAttributes
         } = props;

        let jsx;
        
        function selectTheme( value ) {
            setAttributes( { theme: value } );
        }

        const event = new Event('musicPlayerInitialize');
        document.dispatchEvent( event );

        jsx = [
            <InspectorControls key="all-in-one-music-player-theme-selector-inspector-controls">
                <PanelBody title= { __( 'All in One Music Player Settings', 'all-in-one-music-player' ) }>
                    <SelectControl
                        label= { __( 'Select Theme', 'all-in-one-music-player' ) }
                        value= { theme }
                        placeholder= { __( 'Select A Music Player', 'all-in-one-music-player' ) }
                        options={[
                                { value: '', label: __( '-- Select A Music Player --', 'all-in-one-music-player' ) },
                                { value: 'a-player', label: 'APlayer' },
                                { value: 'circular-spikes', label: 'Circular Spikes' },
                                { value: 'flat-black', label: 'Flat Black' },
                                { value: 'blue-playlist', label: 'Blue Playlist' }
                            ]}    
                        onChange={ selectTheme }
                    />
                </PanelBody>
            </InspectorControls>
        ];

		if ( theme ) {
        	jsx.push(
                <ServerSideRender
                    key="all-in-one-music-player-server-side-renderer"
                    block="all-in-one-music-player/music-player-selector"
                    attributes={ props.attributes }
                />
            );
        } else {
        	jsx.push(
				<Placeholder
					key="all-in-one-music-player-selector-wrap"
					className="all-in-one-music-player-selector-wrap">
					<img src={ 'https://sanjeebaryal.com.np/wp-content/plugins/internet-connection-status/assets/logo.png' }/>
					<h3> { 'All in One Music Player' }</h3>
					<SelectControl
						key="all-in-one-music-player-selector-select-control"
						value={ theme }
                        placeholder= { __( 'Select A Music Player', 'all-in-one-music-player' ) }
                        options={[
                                { value: '', label: __( '-- Select A Music Player --', 'all-in-one-music-player' ) },
                                { value: 'a-player', label: 'APlayer' },
                                { value: 'circular-spikes', label: 'Circular Spikes' },
                                { value: 'flat-black', label: 'Flat Black' },
                                { value: 'blue-playlist', label: 'Blue Playlist' }
                            ]}
                        onChange={ selectTheme }
					/>
				</Placeholder>
			);
        }

        return jsx;
    },
    save( { attributes, className } ) {
        // Gutenberg will save attributes we can use in server-side callback
       return null;
    },
});
