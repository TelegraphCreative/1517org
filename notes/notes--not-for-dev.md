---- LB Hit List ----

-   Misc
    x Require - Contact Form Ext. - Contact Email Template Ext.
    x Setup Speaker Form
    x Fix dep warnings
    x Add SMTP settings to .env
    x Cleanup longform blocks
    x Add form fields in CMS
    x Connect Social icons

-   Setup GC Structure
    x bio cards
    x slider
    x entry callout
    x billboard 2up
    x fix bio card
    x add forms as singles (easier to link to as entries)
    \_ billboard text?
    \_ Setup GC Template

-   Commerce
    \_ Commerce Styles

-   Courses
    \_ Setup Course Registration Form
    \_ Groupie Plugin assigns them to a group
    \_ Add checkbox and Mailchimp Subscribe
    \_ Add Login / Forgot Pw page

-   GDPR
    \_ Add cookie banner and Craft Cookie plugin to setup a section of scripts only loaded with user thumbsup (forms are all compliant, nothing currently loading that isn't but the toaser is the ultimate gdpr c. thing, want to avoid questions and have a basis for adding tracking in place later)

---- Templating Notes ----

-   Courses notes:

*   course user signs up
*   only notifications for are system default active your account
*   how does that play out w/ no access to backend?


    ---- Templating Notes ----

# -Te Article Entry

[x] product link
[x] blogcast, video, or hero image
[x] author
[x] subscribe blog cast billboard

# -Te Section

[x] featured entry hero
[x] switch statement for entry formats
[x] filter lists

# FED for Podcast Entry

[x] big list*
[x] subscribe billboard\*^^ (needs service icons)
[x] button group ^^
[x] entry callout*^^
[x] billboard (floated)_
[x] related entry cards_^^

# FED for Podcast Section

[x] Featured Podcast*^^
[x] Add action*

-   needs templating
    ^^ fed done, needs tweaked

# Notes

[x] Billboard themes auto update inner buttons/links (text)

# Structures/Misc

[x] Podcast Index
[ ] Match Article to Podcast

---- Archived Colors ----

# Grey

    'ivory-lighter': '#F0EDEB',
    'ivory-light': '#F7F4F2',
    'grey': '#EAE2DB',
    'grey-dark': '#BABABA',
    'grey-darker': '#7D8082',
    'grey-darkest': '#3D3B49',

# Slate

    'slate': '#363B3D',
    'slate-dark': '#292C2E',

## Clay

    'red': '#CC4D39', (default text/link hover)
    'red-darker': '#B54635',

## Sage

    'sage-lighter': '#EAF2F0',
    'sage-light': '#D3DAD8',
    'sage': '#B1C4BF',
    'sage-dark': '#4C5357',
    'sage-darker': '#3E4A50', (text)
    'sage-darkest': '#394347',

## Yellow

    'yellow-lighter': '#E0CCB8',
    'yellow-light': '#D1AA86',
    'yellow': '#DF922D',
    'bronze': '#BAA188',
    'bronzeer': '#AD8D71',

---- Archived Tailwind ----
// Grey
'ivory-lighter': '#F0EDEB',
'ivory-light': '#F7F4F2',
grey: '#EAE2DB',
grey: '#EAE2DB',
'grey-dark': '#BABABA',
'grey-darker': '#7D8082',
'grey-darkest': '#3D3B49',

// Sage
'sage-lighter': '#EAF2F0',
'sage-light': '#D3DAD8',
sage: '#B1C4BF',
'sage-dark': '#4C5357',
'sage-darker': '#3E4A50', // (text)
'sage-darkest': '#394347',

// Neutral
'slate-darker': '#333333',

// Slate
slate: '#363B3D',
'slate-dark': '#2A4242',
'slate-darker': '#292C2E',
'slate-darkest': '#262626',

// Yellow
'yellow-lighter': '#E0CCB8',
'yellow-light': '#D1AA86',
yellow: '#DF922D',
'bronze': '#BAA188',
'bronzeer': '#AD8D71',

// Red
red: '#CC4D39', // (default text/link hover)
'red-dark': '#b34230',
'red-darker': '#452621',

---- All Colors (lifted from Abstract) ----
#3D3B49
#363B3D
#333333
#3E4A50
#394347
#005450
#7D8082
#D3DAD8
#B1C4BF

#CC4D39 (key red)
#b34230 (dark on key red)
#943223 (dark red)

#B84735
#C74B38
#B34332
#B33636
#A84131
#B54635

#EAE2DB
#E0CCB8
#CDC1B5
#D4B190
#D1AA86
#BAA188
#AD8D71
#C2B499

#2A4242

#ED845A

#000000
#101519
#292C2E
#131B1E
#262626
#121A1D

#D2D9D7
#3D3B49
#4C5357
#394347
#1A1A1A

#2A4242
#EDD67B

#394347

#F7F4F2
#F5F1ED
#FBF9F8

rgba(0, 0, 0, 0.22)
rgba(38, 38, 38, 0.4)
rgba(247, 244, 242, 0.5)
rgba(193, 209, 205, 0.5)
rgba(245, 241, 237, 0.5)
rgba(181, 70, 53, 0.8)
