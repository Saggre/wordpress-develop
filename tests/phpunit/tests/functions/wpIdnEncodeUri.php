<?php

/**
 * Tests for the wp_idn_encode_uri() function
 *
 * @group functions.php
 * @covers ::wp_idn_encode_uri
 */
class Tests_Functions_wpIdnEncodeUri extends WP_UnitTestCase {

	/**
	 * Tests wp_idn_encode_uri().
	 *
	 * @dataProvider data_wp_idn_encode_uri
	 *
	 * @param string $test_value Test value.
	 * @param string $expected Expected return value.
	 */
	public function test_wp_idn_encode_uri( $test_value, $expected ) {
		$this->assertSame( $expected, wp_idn_encode_uri( $test_value ) );
	}

	/**
	 * Data provider for test_wp_idn_encode_uri().
	 *
	 * @return array[] Test parameters {
	 * @type string $test_value Test value.
	 * @type string $expected Expected return value.
	 * }
	 */
	public function data_wp_idn_encode_uri() {
		return array(
			array( null, false ),
			array( 10, false ),
			array( '', false ),
			array( 'https://wordpress.org', 'https://wordpress.org/' ),
			array( 'https://wordpress.org/', 'https://wordpress.org/' ),
			array( 'https://www.wordpress.org?foo=bar#anchor', 'https://www.wordpress.org/?foo=bar#anchor' ),
			array( 'https://dass.example', 'https://dass.example/' ),
			array( 'https://müller', 'https://xn--mller-kva/' ),
			array( 'https://weißenbach', 'https://xn--weienbach-i1a/' ),
			array( 'https://يوم-جيد', 'https://xn----9mcj9fole/' ),
			array( 'https://יום-טוב', 'https://xn----2hckbod3a/' ),
			array( 'https://idndomainäaöoüuexample.example', 'https://xn--idndomainaouexample-owb39ane.example/' ),
			array( 'https://öko.example', 'https://xn--ko-eka.example/' ),
			array( 'https://æšŧüø.example', 'https://xn--6ca0bl71b4a.example/' ),
			array( 'https://ìåíèäæìúíò.example', 'https://xn--4cabegsede9b0e.example/' ),
			array( 'https://мениджмънт.example', 'https://xn--d1abegsede9b0e.example/' ),
			array( 'https://3+1', 'https://3+1/' ),
			array( 'https://www.bäckermüller.example', 'https://www.xn--bckermller-q5a70a.example/' ),
			array( 'https://ı', 'https://xn--cfa/' ),
			array( 'https://ekşisözlük', 'https://xn--ekiszlk-d1a0dy4d/' ),
			array( 'https://rådetforstørrefærdselssikkerhed', 'https://xn--rdetforstrrefrdselssikkerhed-znc6bz8b/' ),
			array( 'https://kaşkavalcı.example', 'https://xn--kakavalc-0kb76b.example/' ),
			array( 'https://πι.example', 'https://xn--uxan.example/' ),
			array( 'https://księgowość.example', 'https://xn--ksigowo-c5a1nq1a.example/' ),
			array( 'https://регистрациядоменов.example', 'https://xn--80aebfcdsb1blidpdoq4e1i.example/' ),
			array( 'https://国际域名.公司', 'https://xn--eqr31enth05q.xn--55qx5d/' ),
			array( 'https://áéíóöúü.example', 'https://xn--1caqmypyo.example/' ),
			array( 'https://áéíóöőúüű.example', 'https://xn--1caqmypyo29d8i.example/' ),
			array( 'https://대출.example', 'https://xn--vk1bq81c.example/' ),
			array( 'https://Ｔシャツ', 'https://xn--t-mfutbzh/' ),
			array( 'https://www.குண்டுபாப்பா.example', 'https://www.xn--clcul3aaa2lcuc4kf.example/' ),
			array( 'https://한국', 'https://xn--3e0b707e/' ),
			array( 'https://파티하임.example', 'https://xn--xu5bx2sncw5i.example/' ),
			array( 'https://가가', 'https://xn--o39aa/' ),
			array( 'https://מילון-ראשׁי.תיבות.וקיצורים', 'https://xn----5gc8bsteqom5gm.xn--5dbik1ed.xn--9dbalbu5cfl/' ),
			array( 'https://írjajézuskának', 'https://xn--rjajzusknak-r7a3h5b/' ),
			array( 'https://น้ำหอม', 'https://xn--q3cq3aix1l2a/' ),
			array( 'https://สำนวน', 'https://xn--q3ca5bk4b5k/' ),
			array( 'https://chambres-dhôtes.example', 'https://xn--chambres-dhtes-bpb.example/' ),
			array( 'https://น้ำใสใจจริง.example', 'https://xn--72cba0e8bxb3cu4kb6d6b.example/' ),
			array( 'https://bären-mögen-füsse.example', 'https://xn--bren-mgen-fsse-5hb70axd.example/' ),
			array( 'https://daß.example', 'https://xn--da-hia.example/' ),
			array( 'https://dömäin.example', 'https://xn--dmin-moa0i.example/' ),
			array( 'https://äaaa.example', 'https://xn--aaa-pla.example/' ),
			array( 'https://aäaa.example', 'https://xn--aaa-qla.example/' ),
			array( 'https://aaäa.example', 'https://xn--aaa-rla.example/' ),
			array( 'https://aaaä.example', 'https://xn--aaa-sla.example/' ),
			array( 'https://déjà.vu.example', 'https://xn--dj-kia8a.vu.example/' ),
			array( 'https://efraín.example', 'https://xn--efran-2sa.example/' ),
			array( 'https://ñandú.example', 'https://xn--and-6ma2c.example/' ),
			array( 'https://Foo.âBcdéf.example', 'https://foo.xn--bcdf-9na9b.example/' ),
			array( 'https://موقع.وزارة-الاتصالات.مصر', 'https://xn--4gbrim.xn----ymcbaaajlc6dj7bxne2c.xn--wgbh1c/' ),
			array( 'https://fußball.example', 'https://xn--fuball-cta.example/' ),
			array( 'https://היפא18פאטאם', 'https://xn--18-uldcat6ad6bydd/' ),
			array( 'https://فرس18النهر', 'https://xn--18-dtd1bdi0h3ask/' ),
		);
	}
}
