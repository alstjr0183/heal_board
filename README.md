# heal_board
힐링 게시판 php + 바닐라js
http://webdev.iptime.org/yms/heal/ 이 주소로 배포했습니다!

이 포트폴리오는 처음으로 제가 목적을 가지고 만들었던 결과물입니다
저는 사람들에게 위로가 될만한 서비스를 만들어 보는 것이 목표이고 이것을 만들었을 때도 그런 마음으로 만들었지만, 현재도 늘 가지고 있는 마음입니다.
게시판을 처음에 만들 땐 db를 이용한 관계성을 만들어 연결을 시키는 것이 너무 어려웠습니다. 가장 어려웠던 부분은
게시판 기능중에 게시물에 좋아요 기능을 넣으려고 했었습니다 단순히 좋아요 수를 올라가게 하는것은 어렵지않았지만 계정당 하나의 좋아요만 쓸수있게 해보려고 하니 생각보다 어려웠었습니다
많은 고민을 통해 db테이블을 하나 만들어 좋아요를누른아이디와 그 게시물의번호 컬럼을 넣어 if문을 사용해 만약 좋아요를누른 정보가 있으면 delete쿼리문을 사용해 추천취소를 하였고
그렇지않다면 update문을 사용해 다시 추천을 올릴수있는 그런 방식으로 구현을 해보았습니다 
구현하고나면 그렇게 대단한 코드가아닌데 당시에는 정말 많은 고민을해 해결하였습니다 (best.php)파일에있습니다.
백엔드를 구현해보면서 이렇게 서비스를 만들 수 있다는 점이 매우 재미있었습니다. 간단한 crud 게시판을 만드는 것은 쉽지만 디테일한 기능 하나하나를 추가하면서 완성도 있는 결과물을 만들기가 쉽지 않다는걸 느꼈습니다.
